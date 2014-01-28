<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/class.MainNews.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/class.Image.php';

$imgs = $_image->GetRandomImages();
$smarty->assign('imgs', $imgs)
       ->assign('mainNews', $_mainNews->GetAll())
       ->display('index.tpl');
?>