<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/class.Entity.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/class.Image.php';

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

   public function IsSuitableAge($userAge, $age)
   {
      $result = true;
      if ($age == 0) {
         $result =  8 <= $userAge && $userAge <= 12;
      } elseif ($age == 1) {
         $result =  13 <= $userAge && $userAge <= 18;
      } elseif ($age == 2) {
         $result =  19 <= $userAge && $userAge <= 30;
      }
      return $result;
   }

   public function GetCatalogView($category = null, $age = -1)
   {
      global $_image;
      $images = $_image->CreateSearchForCatalog($category)->GetAll();
      $users = $this->GetAll();
      $result   = Array();
      $usersRes = Array();
      foreach ($images as $image) {
         foreach ($users as $user) {
            if ($image['images_user_id'] == $user['users_id'] && $this->IsSuitableAge($user['users_age'], $age)) {
               $result[] = $image;
               if (empty($usersRes[$user['users_id']])) {
                  $usersRes[$user['users_id']] = $user;
               }
            }
         }
      }
      return Array($result, $usersRes);
   }
}

$_user = new User();
?>