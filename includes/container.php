<?php
if(!isset($_SESSION)) {
   @session_start();
}

require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/settings.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/constants.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/smarty/libs/Smarty.class.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/class.DataHandling.php';

require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/reg_auth.inc';


$smarty = new TSmarty();
$smarty->force_compile = true;

$data_h       = new DataHandling();
$isAjaxScript = false;

$smarty->assign('isLogin', Authentification::CheckCredentials());
?>