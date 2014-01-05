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
}

?>