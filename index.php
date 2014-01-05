<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/container.php';

$request = explode('/', substr($_SERVER['REQUEST_URI'], 1));

switch ($request[0]) {
   case '': case null: case false:
      $smarty->display('index.tpl');
      break;

   case 'login':
      require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/login.php';      
      break;
      
   case 'registration':
      require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/registration.php';      
      break;

   case 'profile':
      require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/account.php';
      break;

   case 'all_works':
      require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/all_works.php';
      break;
}

?>