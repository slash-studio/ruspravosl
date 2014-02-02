<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/connect.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/encryption.inc';
require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/exception.inc';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/constants.php';

class Cookie
{
   //cookie data
   private
      $pass,
      $login;

   //cookie format info
   private static $glue         = '|';
   private static $cookiepath   = '/';
   private static $cookiename   = 'USERAUTH';
   private static $expiration   = COOKIE_LIFETIME;
   private static $cookiedomain = COOKIE_SITE;

   private function _package()
   {
      $parts  = Array($this->login, $this->pass);
      $cookie = implode(self::$glue, $parts);
      return Encryption::encrypt($cookie);
   }

   private function _unpackage($cookie)
   {
      $buffer = Encryption::decrypt($cookie);
      list($this->login, $this->pass) = explode(self::$glue, $buffer);
   }


   function __construct($login = null, $pass = null)
   {
      if (!empty($login)) {
         $this->pass  = $pass;
         $this->login = $login;
      } else {
         if (array_key_exists(self::$cookiename, $_COOKIE)) {
            $this->_unpackage($_COOKIE[self::$cookiename]);
         } else {
            throw new CookieException();
         }
      }
   }

   public function GetLogin()
   {
      return $this->login;
   }

   public function GetPass()
   {
      return $this->pass;
   }

   public function Set()
   {
      $cookie = $this->_package();
      $time = time() + self::$expiration;
      setcookie(self::$cookiename, $cookie, $time, self::$cookiepath, self::$cookiedomain);
   }

   public function Remove()
   {
      setcookie(self::$cookiename, "", 0, self::$cookiepath, self::$cookiedomain);
   }

   public function Validate($contest_id)
   {
      $user = UserDB::FindByLogin($this->login, $contest_id);
      if (!$user->isExist || $user->password != $this->pass) {
         $this->Remove();
         throw new CookieException();
      }
   }

}

?>