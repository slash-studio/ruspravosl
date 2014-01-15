<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/exception.inc';

class Validate
{

   public static function IsNumeric($var, $raiseException = false)
   {
      $result = empty($var) || (strlen($var) <= 10 && preg_match('/^-?[0-9]{1,4}$/', $var));
      if (!$result && $raiseException) {
         throw new ValidateException("$var не является числом");
      }
      return $result;
   }

   public static function IsPositive($var, $raiseException = false)
   {
      $result = empty($var) || ($var > 0);
      if (!$result && $raiseException) {
         throw new ValidateException("$var не является положительным числом");
      }
      return $result;
   }

   public static function IsPositiveOrZero($var, $raiseException = false)
   {
      $result = empty($var) || ($var > 0) || ($var == 0);
      if (!$result && $raiseException) {
         throw new ValidateException("$var не является положительным числом или нулем");
      }
      return $result;
   }

   public static function IsFloat($var, $raiseException = false)
   {
      $result = empty($var) || (strlen($var) <= 10 && preg_match('/^-?[\d]+(|\.[\d]+)$/', $var));
      if (!$result && $raiseException) {
         throw new ValidateException("$var не является дробным числом");
      }
      return $result;
   }

   public static function IsNotEmptyString($var, $raiseException = false)
   {
      $result = $var !== '';
      if (!$result && $raiseException) {
         throw new ValidateException("Пустое значение для $var недопустимо");
      }
      return $result;
   }

   public static function IsBool($var, $raiseException = false)
   {
      $result = empty($var) || $var == '1' || $var == '0' || $var === true || $var === false;
      if (!$result && $raiseException) {
         throw new ValidateException("$var не является boolean");
      }
      return $result;
   }

   public static function IsEmail($var, $raiseException = false)
   {
      $result = preg_match('/^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$/', $var);
      if (!$result && $raiseException) {
         throw new ValidateException("$var не является правильным e-mail-ом");
      }
      return $result;
   }

   public static function IsSetVar($var, $raiseException = false)
   {
      return isset($var);
   }

   public static function IsNotEmpty($var, $raiseException = false)
   {
      $result = !empty($var);
      if (!$result && $raiseException) {
         throw new ValidateException("$var не может иметь пустое значение");
      }
      return $result;
   }

   public static function IsPhone($var, $raiseException = false)
   {
      $result = preg_match('/^((8|\+7)[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{7,10}$/', $var);
      if (!$result && $raiseException) {
         throw new ValidateException("$var не является корректным номером телефона");
      }
      return $result;
   }

   public static function IsLogin($var, $raiseException = false)
   {
      return preg_match('/^[a-zA-Z0-9]+$/', $var);
   }

   public static function IsDate($var, $raiseException = false)
   {
      return (date('Y-m-d', strtotime($var)) == $var);
   }
}

?>
