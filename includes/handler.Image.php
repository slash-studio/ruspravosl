<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/class.Image.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/handler.php';

class ImageHandler extends Handler
{
   public function __construct()
   {
      $this->entity = new Image();
   }
}

$ajaxResult = Array('result' => true, 'message' => 'Операция прошла успешно!');

try {
   $handler = new ImageHandler();
   $handler->Handle($_POST);
} catch (Exception $e) {
   $ajaxResult['result'] = false;
   $ajaxResult['message'] = $e->getMessage();
}
echo json_encode($ajaxResult);
?>