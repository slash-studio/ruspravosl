<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/class.Texts.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/handler.php';

if (isset($_POST['save'])) {
   $post = GetPost();
   $post['mode']   = 'Update';
   $post['params'] = Array(
            'id'        => $post['text_id'],
            'text_body' => $post['text_body'],
            'text_head' => isset($post['text_head']) ? $post['text_head'] : null
        );
   HandleAdminData($_texts, $post, 'texts');
}
$smarty->assign('texts', $_texts->GetAll())
       ->display('admin.text.tpl');
?>