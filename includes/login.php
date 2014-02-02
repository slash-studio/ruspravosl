<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/connect.php';

$fromUri = isset($_GET['originating_uri']) ? $_GET['originating_uri'] : '/profile';
if (Authentification::CheckCredentials($contestID)) {
   header("Location: /profile");
}
$isException = false;
if (isset($_POST['submit'])) {
   $post  = array_map("trim", $_POST);
   $login = $post['login'];
   $pass  = $post['pass'];
   try {
      $data_h->validateForm($post, ERROR_LOGIN)
             ->validateLogin($login, ERROR_LOGIN)
             ->validatePassword($pass, ERROR_LOGIN);
      AuthorizedUser::Login($login, $pass, $contestID);
      header("Location: $fromUri");
   } catch (Exception $e) {
      $isException = true;
      $errorMsg = $e->getMessage();
   }
}


$smarty->assign('login', isset($login) ? $login : '')
       ->assign('fromUri', $fromUri)
       ->assign('errorMsg', isset($errorMsg) ? $errorMsg : false)
       ->display('login.tpl');
?>