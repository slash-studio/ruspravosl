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

   public function GetLastContest()
   {
      $this->CheckSearch();
      $this->AddOrder('contest_date', OT_DESC);
      $this->AddLimit(1, 0);
      $result = $this->GetAll();
      return !empty($result[0]) ? $result[0] : Array();
   }
}

$_contest = new Contest();
?>