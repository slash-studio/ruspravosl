<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/class.SQL.php';

class Search
{
   private
      $table,
      $limit,
      $clause,
      $joins,
      $params,
      $joinFields,
      $joinParams,
      $limitParams,
      $clauseFields,
      $clauseParams,
      $isChangeJoin   = true,
      $isChangeClause = true;


   public function __construct(
      $table,
      $clauseFields = Array(),
      $clauseParams = Array(),
      $joinFields   = Array(),
      $joinParams   = Array(),
      $limitParams  = Array()
   )
   {
      $this->table        = $table;
      $this->limitParams  = $limitParams;
      $this->clauseFields = $clauseFields;
      $this->clauseParams = $clauseParams;
      $this->joinFields   = $joinFields;
      $this->joinParams   = $joinParams;
   }

   public function GetClause()
   {
      if ($this->isChangeClause) {
         $clause = '';
         foreach ($this->clauseFields as $fields) {
            $clause .= $fields[2]
                     . ' '
                     . $fields[3]
                     . $fields[1]->GetView($fields[0], $fields[5])
                     . $fields[4]
                     . ' ';
         }
         $this->clause         = $clause;
         $this->isChangeClause = false;
      }
      return $this->clause;
   }

   public function GetJoins()
   {
      if ($this->isChangeJoin) {
         $this->joins        = SQL::MakeJoin($this->table, $this->joinFields);
         $this->isChangeJoin = false;
      }
      return $this->joins;
   }

   public function GetParams()
   {
      return array_merge($this->clauseParams, $this->joinParams, $this->limitParams);
   }

   public function GetLimit()
   {
      return !empty($this->limitParams);
   }

   public function AddClause($field, $param)
   {
      $this->isChangeClause = true;
      $field[2]             = count($this->clauseFields) > 0 ? $field[2] : '';
      $this->clauseFields[] = $field;
      $this->clauseParams[] = $param;
      return $this;
   }

   public function RemoveLastClause()
   {
      $this->isChangeClause = true;
      array_pop($this->clauseFields);
      array_pop($this->clauseParams);
      return $this;
   }

}
?>