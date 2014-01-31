<?php
if (empty($isAjaxScript)) {
   @session_start();
}
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/class.Entity.php';

$ajaxResult = Array('result' => true, 'message' => 'Операция прошла успешно!');

class Handler
{
   public $entity;

   public function __construct($entity)
   {
      $this->entity = $entity;
   }

   public function SetFields($params)
   {
      foreach ($params as $name => $value) {
         $this->entity->SetFieldByName($name, $value);
      }
   }

   public function Update($params)
   {
      try {
         $this->SetFields($params);
         $this->entity->Update();
      } catch (DBException $e) {
         throw new Exception('Возникли проблемы при обновлении записи.');
      }
   }

   public function Insert($params, $getLastInsertId = true)
   {
      try {
         $this->SetFields($params);
         return $getLastInsertId ? $this->entity->Insert(true) : $this->entity->Insert(false);
      } catch (DBException $e) {
         throw new Exception('Возникли проблемы при добавлении записи.');
      }
   }

   public function Delete($params)
   {
      try {
         $this->entity->Delete($params['id']);
      } catch (DBException $e) {
         throw new Exception("Возникли проблемы при удалении записи.");
      }
   }

   public function Handle($in)
   {
      try {
         return $this->$in['mode'](isset($in['params']) ? $in['params'] : Array());
      } catch (ValidateException $e) {
         throw new Exception($e->getMessage());
      }
   }
}

function HandleAdminData($obj, $post, $url)
{
   $handler = new Handler($obj);
   try {
      $handler->Handle($post);
      header("Location: /admin/$url");
   } catch (Exception $e) {
      global $smarty;
      $smarty->assign('error_txt', $e->getMessage());
   }
}
?>