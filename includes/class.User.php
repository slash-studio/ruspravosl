<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/class.Entity.php';

class User extends Entity
{
   const TABLE = 'users';

   public function __construct()
   {
      $this->fields = Array(
         new Field(
            'id',
            NULL,
            false
         ),
         new Field(
            'login',
            NULL,
            true,
            Array('IsSetVar', 'IsPositiveOrZero', 'IsNumeric')
         ),
         new Field(
            'name',
            NULL,
            true,
            Array('IsSetVar'),
            'Like'
         ),
         new Field(
            'surname',
            NULL,
            true,
            Array('IsSetVar'),
            'Like'
         ),
         new Field(
            'age',
            NULL,
            true,
            Array('IsPositive')
         ),
         new Field(
            'address',
            NULL,
            true,
            Array('IsSetVar'),
            'Like'
         ),
         new Field(
            'school',
            NULL,
            true,
            Array('IsSetVar'),
            'Like'
         ),
         new Field(
            'password',
            NULL,
            true,
            Array('IsSetVar', 'IsNotEmptyString')
         )
      );
   }
}

$_user = new User();
?>