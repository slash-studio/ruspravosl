<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/userDB.inc';
require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/cookie.inc';

//------------class Authentification------------

class Authentification
{
   public static function CheckCredentials()
   {
      $isAuth = true;
      if (empty($_SESSION['login'])) {
         try {
            $cookie = new Cookie();
            $cookie->Validate();
            AuthorizedUser::authorize($cookie->GetLogin(), $cookie->GetPass());
         } catch (CookieException $e) {
            $isAuth = false;
         } catch (Exception $e) {
            $isAuth = false;
         }
      }
      return $isAuth;
   }

}

//------------class Registration------------

class Registration
{
   public static function Register(
      $login,
      $password,
      $name,
      $surname,
      $age,
      $address,
      $school
   )
   {
      global $db, $data_h;
      $user = new UserDB($login);

      $user->salt = Encryption::generateRandomString();
      $user->password = $password;

      if ($user->isExist) {
         throw new Exception(ERROR_LOGIN_ALREADY_REGISTERED);
      } else {
         $user->name    = $name;
         $user->school  = $school;
         $user->surname = $surname;
         $user->age     = $age;
         $user->address = $address;
         $user->Insert();
         $user = new UserDB($login);
         AuthorizedUser::authorize($login, $user->password, true);
      }
   }

}

//------------class AuthorizedUser------------

class AuthorizedUser
{
   public static function Login($login, $pass)
   {
      global $db;
      $user = UserDB::FindByLogin($login);
      if (!$user->isExist) {
         throw new Exception(ERROR_LOGIN);
      }
      $result = $db->Query('SELECT create_encrypted_pass(?, ?) as db_pass', Array($pass, $user->salt));
      $encryptpass = $result[0]['db_pass'];
      if ($encryptpass == $user->password) {
         self::Authorize($login, $encryptpass, true);
      } else {
         throw new Exception(ERROR_LOGIN);
      }
   }

   public static function Authorize($login, $pass, $isCookie = false)
   {
      $_SESSION['login'] = $login;
      if ($isCookie) {
         $cookie = new Cookie($login, $pass);
         $cookie->Set();
      }
   }

   public static function Unauthorized()
   {
      $_SESSION['login'] = null;
      try {
         $cookie = new Cookie();
         $cookie->Remove();
      } catch (CookieException $e) {
         //
      }
      unset($_SESSION['login']);
      // session_destroy();
   }

   public static function changePassword($email, $oldPass, $newPass)
   {
      global $data_h;
      $data_h->validatePassword($newPass);

      try {
         self::login($email, $oldPass);
      } catch (Exception $e) {
         throw new Exception(ERROR_PASS);
      }

      $user = new UserDB($email);
      $user->password = $newPass;
      $user->update();

      self::authorize($email, $user->password, true);
   }

   public static function forgottenPassword($email)
   {
      $user = new UserDB($email);
      if (!$user->isExist) {
         throw new Exception(INCORRECT_MAIL);
      }

      global $data_h;
      $new_pass = Encryption::generateRandomString(10);
      $user->password = $new_pass;
      $user->verification = false;
      $user->register_date = time();
      $user->update();

      return $new_pass;
   }

   public static function deleteAccount($email)
   {
      $user = new UserDB($email);
      $user->delete();
      self::unauthorized();
   }

}

?>