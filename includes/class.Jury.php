<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/class.Entity.php';

class Jury extends Entity
{
   const TABLE = 'jury';

   public function __construct()
   {
      $this->fields = Array(
         new Field(
            'id',
            1,
            false
         ),
         new Field(
            'name',
            null,
            true,
            Array('IsNotEmpty')
         ),
         new Field(
            'info',
            null,
            true,
            Array('IsNotEmpty')
         )
      );
   }
}

$_jury = new Jury();
?>