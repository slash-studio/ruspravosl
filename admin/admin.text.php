<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/class.MainNews.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/class.CompetitiveButton.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/handler.php';

if (isset($_POST['save']) || isset($_POST['enable_competitive'])) {
   $post = array_map('trim', $_POST);
   $post['mode']   = 'Update';
   $post['params'] =
      isset($_POST['save'])
      ? Array('text_body' => $post['text_body'], 'text_head' => $post['text_head'])
      : Array('status' => $post['competitive_status'] % 2);
   $handler = isset($_POST['save']) ? new Handler($_mainNews) : new Handler($_competitiveButton);
   $handler->Handle($post);
}
$result = $_competitiveButton->GetAll();
$smarty->assign('competitiveStatus', $result[0]['competitive_button_status'])
       ->assign('mainNews', $_mainNews->GetAll())
       ->display('admin.text.tpl');
?>