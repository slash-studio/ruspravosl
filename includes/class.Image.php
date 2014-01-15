<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/class.Entity.php';


class Image extends Entity
{
   const TABLE = 'images';

   public function __construct()
   {
      $this->fields = Array(
         new Field(
            'id',
            null,
            false
         ),
         new Field(
            'user_id',
            null
         ),
         new Field(
            'category_id',
            null
         ),
         new Field(
            'status',
            null
         ),
      );
   }

   public function CreateSearch($categoryId = null, $userId = null)
   {
      unset($this->search);

      $hasClause = false;
      $whereFields = Array();
      $whereParams = Array();

      if (isset($userId)) {
         $whereParams[] = $userId;
         $whereFields[] = PackParam(self::TABLE, $this->GetFieldByName('user_id'));
         $hasClause = true;
      }

      if (isset($categoryId)) {
         $whereParams[] = $categoryId;
         $whereFields[] = PackParam(self::TABLE, $this->GetFieldByName('category_id'), $hasClause, 'AND');
         $hasClause = true;
      }

      $this->search = new Search(self::TABLE, $whereFields, $whereParams);
      return $this;
   }

   public function GetImagesForUser($user_id)
   {
      $this->CheckSearch();
      $this->search->AddClause(PackParam(static::TABLE, $this->GetFieldByName('user_id')), $user_id);
      $result = $this->GetAll();
      $this->search->RemoveLastClause();
      return $result;
   }

   public function Delete($id)
   {
      parent::Delete($id);
      @unlink($_SERVER['DOCUMENT_ROOT'] . '/includes/uploads/' . $id . '_b.jpg');
      @unlink($_SERVER['DOCUMENT_ROOT'] . '/includes/uploads/' . $id . '_s.jpg');
   }
}

$_image = new Image();
?>