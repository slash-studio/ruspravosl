<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/class.Entity.php';

class CompetitiveButton extends Entity
{
   const TABLE = 'competitive_button';

   public function __construct()
   {
      $this->fields = Array(
         new Field(
            'id',
            1,
            false
         ),
         new Field(
            'status',
            null,
            true,
            Array('IsPositiveOrZero')
         )
      );
   }
}

$_competitiveButton = new CompetitiveButton();
?>