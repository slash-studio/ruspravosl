<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/container.php';

// $_POST['mode'] = 'Update';
// $_POST['params'] = Array('name' => 'Декоративно приклад', 'id' => 4, 'parent_id' => 4);
// require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/handler.Category.php';
// exit;

$request = explode('/', substr($_SERVER['REQUEST_URI'], 1));

switch ($request[0]) {
   case '': case null: case false:
      require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/class.MainNews.php';
      require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/class.CompetitiveButton.php';
      $result = $_competitiveButton->GetAll();
      $smarty->assign('competitiveStatus', $result[0]['competitive_button_status'])
             ->assign('mainNews', $_mainNews->GetAll())
             ->display('index.tpl');
      break;

   case 'login':
      require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/login.php';
      break;

   case 'registration':
      require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/registration.php';
      break;

   case 'success_reg':
      require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/success_reg.php';
      break;

   case 'profile':
      require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/account.php';
      break;

   case 'all_works': case 'category':
      require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/all_works.php';
      break;

   case 'jury':
      require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/class.Jury.php';
      $smarty->assign('jury', $_jury->GetAll())
             ->display('jury.tpl');
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

         case 'main_news':
            require_once $_SERVER['DOCUMENT_ROOT'] . '/admin/admin.text.php';
            break;

         case 'categories':
            require_once $_SERVER['DOCUMENT_ROOT'] . '/admin/admin.categories.php';
            break;

         case 'photos':
            require_once $_SERVER['DOCUMENT_ROOT'] . '/admin/admin.photos.php';
            break;
      }
      break;
}

?>