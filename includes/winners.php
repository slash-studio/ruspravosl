<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/class.Category.php';

$smarty->assign('cats', $_category->MakeWinnerTree($contestID))
       ->display('winners.tpl');
?>