<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/container.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/class.Category.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/class.Image.php';

if (!Authentification::CheckCredentials()) {
   header("Location: /login/?originating_uri=" . $_SERVER['REQUEST_URI']);
}
$user = new UserDB($_SESSION['login']);
$smarty->assign('cats', $_category->MakeAccountTree($user->id))
       ->assign('id', $user->id)
       ->assign('login', $user->login)
       ->assign('fullname', $user->name . ' ' . $user->surname)
       ->assign('age', $user->age)
       ->assign('address', $user->address)
       ->assign('school', $user->school)
	   ->assign('acc_self', 1)
       ->display('account.tpl');
?>