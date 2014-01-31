<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/class.Entity.php';

class Texts extends Entity
{
   const TABLE = 'texts';

   public function __construct()
   {
      parent::__construct();
      $this->fields = Array(
         new Field(
            'id',
            null,
            false
         ),
         new Field(
            'text_head'
         ),
         new Field(
            'text_body'
         )
      );
   }
}

$_texts = new Texts();
?>