<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/class.Texts.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/class.Image.php';

$imgs = $_image->GetRandomImages();
$smarty->assign('imgs', $imgs)
       ->assign('text', $_texts->GetById(MAIN_TEXT_ID))
       ->display('index.tpl');
?>