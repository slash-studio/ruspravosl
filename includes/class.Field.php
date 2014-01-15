<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/class.Validate.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/class.SQL.php';

class FieldView
{
   public static function Like($extra)
   {
      return ' LIKE UPPER(?)';
   }

   public static function General($relOp)
   {
      return ' ' . $relOp . ' ?';
   }
}

class Field
{
   private
      $value;

   public
      $view,
      $name,
      $canChange,
      $validate = Array();

   public function __construct($name, $value = null, $canChange = true, $validate = Array(), $view = 'General')
   {
      $this->name      = $name;
      $this->view      = $view;
      $this->value     = $value;
      $this->validate  = $validate;
      $this->canChange = $canChange;
   }

   public function Validate()
   {
      foreach ($this->validate as $func) {
         Validate::$func($this->value, true);
      }
      return $this;
   }

   public function GetView($table, $extra)
   {
      $func = $this->view;
      return
         SQL::ToTblNm($table, $this->name)
       . FieldView::$func($extra);
   }

   public function ResetField()
   {
      $this->value = null;
      return $this;
   }

   public function IsSetField()
   {
      return isset($this->value);
   }

   public function SetValue($value)
   {
      $this->value = $value;
      return $this;
   }

   public function GetValue()
   {
      return $this->value;
   }

   public function GetName()
   {
      return $this->name;
   }
}
?>