<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/constants.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/handler.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/class.Category.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/class.Image.php';

class CategoryHandler extends Handler
{
   public function __construct()
   {
      $this->entity = new Category();
   }

   public function Insert($params, $getLastInsertId = true)
   {
      global $db, $_image;
      $parentId = $params['parent_id'];
      $imagesAmount = $_image->CreateSearch($parentId)->GetAllAmount();
      if ($parentId != -1 && !empty($imagesAmount)) {
         throw new Exception("Нельзя добавлять дочерние категории в выбранную. В ней находятся $imagesAmount фотографий.");
      }
      try {
         $db->link->beginTransaction();
         $db->Query('CALL update_cat_path(?)', Array(parent::Insert($params, $getLastInsertId)));
         $db->link->commit();
      } catch (DBException $e) {
         $db->link->rollback();
         throw new Exception('Возникли проблемы при добавлении записи.');
      }
   }

   public function Update($params)
   {
      global $db, $_image;
      $parentId = $params['parent_id'];
      $imagesAmount = $_image->CreateSearch($parentId)->GetAllAmount();
      if ($parentId != $params['id'] && !empty($imagesAmount)) {
         throw new Exception("Нельзя изменить родительскую категорию на указанную. В этой категории находятся $imagesAmount фотографий.");
      }
      try {
         $db->link->beginTransaction();
         parent::Update($params);
         $db->Query('CALL update_cat_path(?)', Array($params['id']));
         $db->link->commit();
      } catch (DBException $e) {
         $db->link->rollback();
         throw new Exception('Возникли проблемы при обновлении записи.');
      }
   }

}

$ajaxResult = Array('result' => true, 'message' => 'Операция прошла успешно!');

try {
   if (!($_SESSION['admin_login'] == ADMIN_LOGIN && $_SESSION['admin_pass'] == ADMIN_PASS)) {
      throw new Exception('You do not have permission for this action');
   }
   $handler = new CategoryHandler();
   $handler->Handle($_POST);
   $ajaxResult['table']   = $_category->MakeAdminTree($_POST['params']['contest_id']);
   $ajaxResult['selects'] = $_category->MakeSelectTree($_POST['params']['contest_id']);
} catch (Exception $e) {
   $ajaxResult['result']  = false;
   $ajaxResult['message'] = $e->getMessage();
}
echo json_encode($ajaxResult);
?>