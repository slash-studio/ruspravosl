<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/class.Jury.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/handler.php';

if (isset($_POST['mode'])) {
   $post = GetPOST();
   $id   = isset($_POST['id'])   ? $_POST['id'] : '';
   $name = isset($_POST['name']) ? $_POST['name'] : '';
   $info = isset($_POST['info']) ? $_POST['info'] : '';
   $post['params'] = Array('name' => $name, 'info' => $info, 'id' => $id);
   if (empty($name)) {
      $smarty->assign('error_txt', 'Имя не может быть пустым!');
   } else {
      HandleAdminData($_jury, $post, 'jury');
   }
}
$smarty->assign('jury', $_jury->GetAll())
       ->display('admin.jury.tpl');
?>