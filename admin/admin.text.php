<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/class.MainNews.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/handler.php';

if (isset($_POST['save'])) {
   $post = array_map('trim', $_POST);
   $post['params'] = Array('text_body' => $post['text_body'], 'text_head' => $post['text_head']);
   $post['mode']   = 'Update';
   $handler = new Handler($_mainNews);
   $handler->Handle($post);
}
$smarty->assign('mainNews', $_mainNews->GetAll())
       ->display('admin.text.tpl');
?>