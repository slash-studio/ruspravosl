<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/class.Entity.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/class.User.php';

class Image extends Entity
{
   const TABLE = 'images';

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

      $this->orderFields = Array('rand' => null);
   }

   public function CreateSearchForCatalog($category = null)
   {
      unset($this->search);

      $hasClause = false;
      $whereFields = Array();
      $whereParams = Array();

      if (!empty($category)) {
         global $_category;
         $whereParams[] = $category;
         $whereFields[] = PackParam(self::TABLE, $this->GetFieldByName('category_id'), $hasClause, 'AND', '(');
         $hasClause     = true;
         $whereParams[] = "%.$category.%";
         $whereFields[] = PackParam(Category::TABLE, $_category->GetFieldByName('path'), $hasClause, 'OR', '', ')');
      }
      $joins = Array(Category::TABLE => Array(null, Array('category_id', 'id')));

      $this->search = new Search(self::TABLE, $whereFields, $whereParams, $joins);
      return $this;
   }

   public function GetRandomImages()
   {
      $this->CheckSearch();
      global $_user;
      $userAgeField     = $_user->GetFieldByName('age');
      $userNameField    = $_user->GetFieldByName('name');
      $userSurnameField = $_user->GetFieldByName('surname');
      $fields =
         array_merge(
            SQL::PrepareFieldsForSelect(
               static::TABLE,
               $this->fields
            ),
            SQL::PrepareFieldsForSelect(
               User::TABLE,
               Array($userNameField, $userSurnameField, $userAgeField)
            )
         );
      $this->UnsetSelectValues();

      $this->selectTables =
         Array(
            static::TABLE => $this->fields,
            User::TABLE   => Array($userNameField, $userSurnameField, $userAgeField)
         );
      $this->selectFields = SQL::GetListFieldsForSelect($fields);
      $join = Array(User::TABLE => Array(null, Array('user_id', 'id')));
      $this->search = new Search(self::TABLE, Array(), Array(), $join, Array(), Array(0, 4));
      $this->AddOrder('rand', OT_RAND);
      return
         $this->SelectWithLang(
            $this->selectTables,
            $this->selectFields,
            $this->search->GetClause(),
            $this->search->GetParams(),
            $this->search->GetJoins(),
            $this->search->GetLimit()
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