<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/connect.php';

if (isset($_POST['submit'])) {
   $post    = array_map('strip_tags', array_map('trim', $_POST));
   $pass    = $post['pass'];
   $repass  = $post['pass_rep'];
   $_SESSION['regInfo'] = Array(
      'login'   => $login   = $post['login'],
      'name'    => $name    = $post['name'],
      'school'  => $school  = $post['school'],
      'surname' => $surname = $post['surname'],
	    'age'     => $age     = $post['age'],
      'address' => $address = $post['address']
    );
   try {
      $data_h->validateForm($post)
             ->validateLogin($login)
             ->validatePositiveNum($age)
             ->validateRepeatPasswords($pass, $repass)
             ->validatePassword($pass);
      Registration::Register($login, $pass, $name, $surname, $age, $address, $school);
      unset($_SESSION['regInfo']);
      header("Location: /success_reg");
   } catch (Exception $e) {
      $errorMsg = $e->getMessage();
   }
}
$smarty->assign('regInfo',  isset($_SESSION['regInfo']) ? $_SESSION['regInfo'] : null)
       ->assign('errorMsg', isset($errorMsg) ? $errorMsg : false)
       ->display('registration.tpl');
?>