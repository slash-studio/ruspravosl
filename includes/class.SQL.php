<?php
class SQL
{
   public static function ToPrfxNm($table, $name)
   {
      return $table . '_' . $name;
   }

   public static function ToTblNm($table, $name)
   {
      return $table . '.' . $name;
   }

   public static function ToWhrCls($names)
   {
      $result = '';
      foreach ($names as $name) {
         $result .= "$name = ?, ";
      }

      return substr($result, 0, strrpos($result, ','));
   }

   public static function MakeJoin($mainTable, $tables)
   {
      $result = '';
      foreach ($tables as $table => $description) {
         $result .= 'INNER JOIN '
            . "$table "
            . (!empty($description[0]) ? $description[0] : '')
            . ' ON ';
         for ($i = 1; $i < count($description); $i++) {
            $result .= self::ToTblNm($mainTable, $description[$i][0])
               . ' = '
               . self::ToTblNm(
                  (!empty($description[0]) ? $description[0] : $table),
                  $description[$i][1]
               )
               . ' AND ';
         }
         $result = substr($result, 0, strrpos($result, 'AND'));
      }

      return $result;
   }

   public static function GetListFieldsForSelect($fields)
   {
      $query = '';
      foreach ($fields as $f) {
         $query .= $f . ', ';
      }

      return substr($query, 0, strrpos($query, ', '));
   }

   public static function GetInsertQuery($table, $fields)
   {
      return
         'INSERT INTO ' . $table . ' (' . implode(', ', $fields) . ') '
         . 'VALUES ('
         . str_repeat('?, ', count($fields) - 1)
         . '?)';
   }

   public static function GetUpdateQuery($table, $fields)
   {
      return
         'UPDATE ' . $table . ' SET ' . implode(' = ?, ', $fields) . ' = ?'
         . ' WHERE id = ?';
   }

   public static function PrepareFieldsForSelect($table, $fields)
   {
      $result = Array();
      foreach ($fields as $f) {
         $field = self::ToTblNm($table, $f->name);
         $result[] = "$field  as " . self::ToPrfxNm($table, $f->name);
      }

      return $result;
   }

   public static function SimpleQuerySelect($fields, $table, $where = null)
   {
      $result = 'SELECT ' . $fields . ' FROM ' . $table;
      if (!empty($where)) {
         $result .= ' WHERE ' . $where;
      }

      return $result;
   }
}

class SQLOrder
{
   private
      $fields = Array();

   public function AddField($fInfo, $orderType)
   {
      $this->fields[] = Array(
         'info' => $fInfo,
         'type' => $orderType
      );
   }

   public function GetOrder()
   {
      $result = '';
      $amount = count($this->fields);
      foreach ($this->fields as $key => $field) {
         $result .= (!empty($field['info']) ? SQL::ToTblNm($field['info'][0], $field['info'][1]->name) : '')
                  . ' '
                  . $field['type']
                  . ($key < $amount - 1 ? ', ' : '');
      }
      return $result;
   }
}

?>