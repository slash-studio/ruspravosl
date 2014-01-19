<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/connect.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/class.SQL.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/class.Field.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/class.Search.php';

function PackParam($table, $field, $bool = false, $cond = '', $lp = '', $rp = '', $relOp = '=') {
   return Array($table, $field, $bool ? $cond : '', $lp, $rp, $relOp);
};

class Entity
{
   const TABLE = '';

   protected
      $selectTables,
      $selectFields;

   public
      $search,
      $order,
      $orderFields = Array(),
      $fields = Array();


   public function __construct()
   {
      $this->order = new SQLOrder();
   }

   public function AddOrder($fieldName, $orderType = OT_ASC)
   {
      if (array_key_exists($fieldName, $this->orderFields)) {
         $this->order->AddField($this->orderFields[$fieldName], $orderType);
      }
      return $this;
   }

   public function AddLimit($amount, $curPage = 0)
   {
      $this->CheckSearch()->search->AddLimit($amount, $curPage);
      return $this;
   }

   protected function GetFieldByName($name)
   {
      foreach ($this->fields as &$f) {
         if ($f->name == $name) {
            return $f;
         }
      }
      return null;
   }

   public function ResetFields()
   {
      foreach ($this->fields as $field) {
         if ($field->canChange) {
            $field->ResetField();
         }
      }
   }

   public function SetFieldByName($name, $value)
   {
      $field = $this->GetFieldByName($name);
      $field->SetValue($value);
      return $this;
   }

   public function GetFieldValueById($id, $name)
   {
      $result = $this->GetById($id);
      return !empty($result) ? $result[$this->ToPrfxNm($name)] : '';
   }

   public function ResetSearch()
   {
      unset($this->search);
      return $this;
   }

   public function CheckSearch()
   {
      if (empty($this->search)) {
         $this->CreateSearch();
      }
      return $this;
   }

   public function CreateSearch()
   {
      $this->ResetSearch();
      $this->search = new Search(static::TABLE);
      return $this;
   }

   public function ToPrfxNm($name)
   {
      return SQL::ToPrfxNm(static::TABLE, $name);
   }

   public function ToTblNm($name)
   {
      return SQL::ToTblNm(static::TABLE, $name);
   }

   public function FromPrfxToTblNm($name)
   {
      return substr($name, strlen(static::TABLE . '_'));
   }

   public function GetTable()
   {
      return static::TABLE;
   }

   public function GetQuery($specific, $table, $where = null, $join = null, $order = null, $limit = false)
   {
      return   "SELECT $specific "
             . ' FROM '
             . $table
             . (!empty($join)  ? " $join "           : '')
             . (!empty($where) ? " WHERE $where "    : '')
             . (!empty($order) ? " ORDER BY $order " : '')
             . ($limit         ? " LIMIT ?, ?"       : '');
   }

   public function AddExtraFields($set)
   {
      return $set;
   }

   public function SelectWithLang(
      $tables, $specific = null, $where = null, $params = Array(), $join = null, $limit = false)
   {
      $result =
         $this->_Select(
            $specific,
            $where,
            $params,
            $join,
            $limit
      );
      foreach ($result as &$set) {
         $set = $this->AddExtraFields($set);
      }
      return $result;
   }

   public function _Select($specific, $where = null, $params = Array(), $join = null, $limit = false)
   {
      try {
         global $db;
         $result =
            $db->Query(
               $this->GetQuery(
                  $specific,
                  static::TABLE,
                  $where,
                  $join,
                  $this->order->GetOrder(),
                  $limit
               ),
               $params
            );
      } catch (Exception $e) {
         $result = Array();
      }
      return $result;
   }

   public function SelectAmount($where = null, $params = Array(), $join = null, $limit = false)
   {
      $cnt = $this->ToPrfxNm('count');
      $result =
         $this->_Select(
                  'COUNT(' . $this->ToTblNm('id') . ") as $cnt",
                  $where,
                  $params,
                  $join,
                  $limit
               );
      return isset($result[0]) ? $result[0][$cnt] : 0;
   }

   public function MakeComplexJoin($join)
   {
      return 'INNER JOIN ' . $join;
   }

   public function UnsetSelectValues()
   {
      unset($this->selectTables);
      unset($this->selectFields);
   }

   public function SetSelectValues()
   {
      $this->CheckSearch();
      $this->UnsetSelectValues();
      $this->selectTables = Array(static::TABLE => $this->fields);
      $this->selectFields = SQL::GetListFieldsForSelect(SQL::PrepareFieldsForSelect(static::TABLE, $this->fields));
   }

   public function GetAll()
   {
      $this->SetSelectValues();
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

   public function GetById($id)
   {
      $this->CheckSearch($lang);
      $this->search->AddClause(PackParam(static::TABLE, $this->GetFieldByName('id'), true, 'AND'), $id);
      $result = $this->GetAll();
      $this->search->RemoveLastClause();
      return !empty($result[0]) ? $result[0] : Array();
   }

   public function SetChangeParams()
   {
      $names  = Array();
      $params = Array();
      $GetArr = function($arr) {
         return is_array($arr) ? $arr : Array($arr);
      };
      foreach ($this->fields as $field) {
         if ($field->canChange && $field->IsSetField()) {
            $field->Validate();
            $names  = array_merge($names,  $GetArr($field->GetName()));
            $params = array_merge($params, $GetArr($field->GetValue()));
         }
      }
      return Array($names, $params);
   }

   public function Insert($getLastInsertId = false)
   {
      global $db;
      list($names, $params) = $this->SetChangeParams();
      $query = SQL::GetInsertQuery(static::TABLE, $names);
      return
         $getLastInsertId
         ? $db->Insert($query, $params, true)
         : $db->Insert($query, $params);
   }

   public function Delete($id)
   {
     global $db;
     $db->Query('DELETE FROM ' . static::TABLE . ' WHERE id = ?', Array($id));
   }

   public function Update()
   {
      global $db;
      list($names, $params) = $this->SetChangeParams();
      $query    = SQL::GetUpdateQuery(static::TABLE, $names);
      $params[] = $this->GetFieldByName('id')->GetValue();
      return $db->Query($query, $params);
   }

   public function GetFieldsValue()
   {
      global $allLangs;
      $result = Array();
      foreach ($this->fields as $field) {
         $value = $field->GetValue();
         $result[$this->ToPrfxNm($field->name)] = $value;
      }
      return $result;
   }

   public function GetAllAmount()
   {
      return
         self::SelectAmount(
            $this->search->GetClause(),
            $this->search->GetParams(),
            $this->search->GetJoins(),
            $this->search->GetLimit()
         );
   }
}

?>