<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/container.php';

// $_POST['mode'] = 'Update';
// $_POST['params'] = Array('name' => 'Декоративно приклад', 'id' => 4, 'parent_id' => 4);
// require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/handler.Category.php';
// exit;

$request = explode('/', substr($_SERVER['REQUEST_URI'], 1));

switch ($request[0]) {
   case '': case null: case false:
      require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/main.php';
      break;

   case 'login':
      require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/login.php';
      break;

   case 'registration':
      require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/registration.php';
      break;

   case 'success_reg':
      $smarty->display('success_reg.tpl');
      break;

   case 'profile':
      require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/account.php';
      break;

   case 'all_works': case 'category':
      require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/all_works.php';
      break;

   case 'winners':
      require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/winners.php';
      break;

   case 'archive':
      require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/archive.php';
      break;

   case 'jury':
      require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/class.Jury.php';
      $smarty->assign('jury', $_jury->GetAll())
             ->display('jury.tpl');
      break;

   case 'archive':
      require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/archive.php';
      break;

   case 'winners':
      require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/404.php';
      break;

   case 'admin':
      $isLoginPage = empty($request[1]) || $request[1] == 'login';
      $_SESSION['admin_login'] = !empty($_SESSION['admin_login']) ? $_SESSION['admin_login'] : '';
      $_SESSION['admin_pass']  = !empty($_SESSION['admin_pass']) ? $_SESSION['admin_pass'] : '';
      if ($_SESSION['admin_login'] == ADMIN_LOGIN && $_SESSION['admin_pass'] == ADMIN_PASS) {
         if ($isLoginPage) {
            header('Location: /admin/main_news');
         }
      } elseif (!$isLoginPage) {
         header('Location: /admin/');
      }
      switch ($request[1]) {
         case '': case 'login': case null: case false:
            require_once $_SERVER['DOCUMENT_ROOT'] . '/admin/admin.login.php';
            break;

         case 'jury':
            require_once $_SERVER['DOCUMENT_ROOT'] . '/admin/admin.jury.php';
            break;

         case 'texts':
            require_once $_SERVER['DOCUMENT_ROOT'] . '/admin/admin.text.php';
            break;

         case 'contests':
            require_once $_SERVER['DOCUMENT_ROOT'] . '/admin/admin.contests.php';
            break;

         case 'photos':
            require_once $_SERVER['DOCUMENT_ROOT'] . '/admin/admin.photos.php';
            break;

         default:
            header('Location: /admin/texts');
            break;
      }
      break;

   case '404':
   default:
      require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/404.php';
      break;
}

?>