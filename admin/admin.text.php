<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/class.Texts.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/class.CompetitiveButton.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/handler.php';

if (isset($_POST['save']) || isset($_POST['enable_competitive'])) {
   $post = array_map('trim', $_POST);
   $post['mode']   = 'Update';
   $post['params'] =
      isset($_POST['save'])
      ? Array(
            'id'        => $post['text_id'],
            'text_body' => $post['text_body'],
            'text_head' => isset($post['text_head']) ? $post['text_head'] : null
        )
      : Array(
            'status' => $post['competitive_status'] % 2
        );
   $handler = isset($_POST['save']) ? new Handler($_texts) : new Handler($_competitiveButton);
   $handler->Handle($post);
   header('Location: /admin/texts');
}
$result = $_competitiveButton->GetAll();
$smarty->assign('competitiveStatus', $result[0]['competitive_button_status'])
       ->assign('texts', $_texts->GetAll())
       ->display('admin.text.tpl');
?>