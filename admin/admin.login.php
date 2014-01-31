<?php
   if (isset($_POST['submit'])) {
      $login = isset($_POST['login']) ? $_POST['login'] : '';
      $pass  = isset($_POST['pass'])  ? $_POST['pass'] : '';
      if ($login == ADMIN_LOGIN && $pass == ADMIN_PASS) {
         $_SESSION['admin_login'] = $login;
         $_SESSION['admin_pass']  = $pass;
         header('Location: /admin/main_news');
      } else {
         $smarty->assign('invalid_pass', true)
                ->assign('admin_login', $login);
      }
   }
   $smarty->display('admin.login.tpl');
?>