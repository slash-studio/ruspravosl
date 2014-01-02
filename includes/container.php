<?php
if(!isset($_SESSION)) {
   @session_start();
}

require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/settings.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/smarty/libs/Smarty.class.php';

$smarty = new TSmarty();
$smarty->force_compile = true;

//$request = explode('/', substr($_SERVER['REQUEST_URI'], 1));

?>