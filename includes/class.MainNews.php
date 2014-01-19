<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/class.Entity.php';

class MainNews extends Entity
{
   const TABLE = 'main_news';

   public function __construct()
   {
      parent::__construct();
      $this->fields = Array(
         new Field(
            'id',
            1,
            false
         ),
         new Field(
            'text_head',
            null,
            true,
            Array('IsNotEmpty')
         ),
         new Field(
            'text_body',
            null,
            true,
            Array('IsNotEmpty')
         )
      );
   }
}

$_mainNews = new MainNews();
?>