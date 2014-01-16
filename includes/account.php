<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/container.php';

if (!Authentification::CheckCredentials()) {
   header("Location: /login/?originating_uri=" . $_SERVER['REQUEST_URI']);
}

$user = new UserDB($_SESSION['login']);
$smarty->assign('id', $user->id)
	   ->assign('login', $user->login)
       ->assign('fullname', $user->name . ' ' . $user->surname)
       ->assign('age', $user->age)
       ->assign('address', $user->address)
       ->assign('school', $user->school)
       ->display('account.tpl');
?>