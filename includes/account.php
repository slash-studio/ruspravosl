<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/class.Category.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/class.Image.php';

$userId = isset($request[1]) ? $request[1] : null;

if (empty($userId)) {
   if (!Authentification::CheckCredentials($contestID)) {
      header('Location: /login/?originating_uri=' . $_SERVER['REQUEST_URI']);
   }
   $user = new UserDB($_SESSION['login'], $contestID);
   $accSelf = true;
} else {
   $user = UserDB::FindById($userId, $contestID);
   $userAuth = new UserDB(isset($_SESSION['login']) ? $_SESSION['login'] : '', $contestID);
   if (!$user->isExist) {
      header('Location: /404');
   }
   $accSelf = $userAuth->isExist && $userAuth->id == $userId;
}
$smarty->assign('cats', $_category->MakeAccountTree($lastContest['contest_id'], $user->id))
       ->assign('id', $user->id)
       ->assign('login', $user->login)
       ->assign('fullname', $user->name . ' ' . $user->surname)
       ->assign('age', $user->age)
       ->assign('address', $user->address)
       ->assign('school', $user->school)
       ->assign('teacher', $user->teacher)
       ->assign('phone', $user->phone)
       ->assign('acc_self', $accSelf)
       ->display('account.tpl');
?>