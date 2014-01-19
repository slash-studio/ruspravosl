<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/class.MainNews.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/class.CompetitiveButton.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/class.Image.php';

$imgs = $_image->GetRandomImages();
$result = $_competitiveButton->GetAll();
$smarty->assign('imgs', $imgs)
       ->assign('competitiveStatus', $result[0]['competitive_button_status'])
       ->assign('mainNews', $_mainNews->GetAll())
       ->display('index.tpl');
?>