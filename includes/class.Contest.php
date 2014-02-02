<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/class.Entity.php';

class Contest extends Entity
{
   const TABLE = 'contest';

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
            'name',
            null,
            true,
            Array('IsNotEmpty')
         ),
         new Field(
            'contest_date',
            null,
            false
         ),
         new Field(
            'status',
            0,
            true
         )
      );
      $this->orderFields = Array('contest_date' => Array(static::TABLE, $this->GetFieldByName('contest_date')));
   }

   public function SetSelectValues()
   {
      $this->CheckSearch();
      $fields =
            SQL::PrepareFieldsForSelect(
               static::TABLE,
               Array($this->GetFieldByName('id'), $this->GetFieldByName('name'), $this->GetFieldByName('status'))
            );
      $fields[] = 'DATE_FORMAT(contest.contest_date, \'%Y\')'
                . ' as '
                . $this->ToPrfxNm('contest_date');

      $this->UnsetSelectValues();

      $this->selectTables = Array(static::TABLE => $this->fields);
      $this->selectFields = SQL::GetListFieldsForSelect($fields);
   }

   public function GetAll()
   {
      $this->SetSelectValues();
      $this->AddOrder('contest_date', OT_DESC);
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

   public function GetLastContest()
   {
      $this->CheckSearch();
      $this->AddLimit(1, 0);
      $result = $this->GetAll();
      return !empty($result[0]) ? $result[0] : Array();
   }
}

$_contest = new Contest();
?>