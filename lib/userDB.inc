<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/connect.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/class.DataHandling.php';

class UserDB
{
   public
      $id;

   public
      $age      = '',
      $salt     = '',
      $name     = '',
      $phone    = '',
      $login    = '',
      $school   = '',
      $surname  = '',
      $teacher  = '',
      $address  = '',
      $password = '';

   public $isExist = false;

   public static function GetIdByLogin($login)
   {
      global $db;
      $data = $db->query('SELECT id FROM users WHERE login = ?', Array($login));
      return $data[0]['id'];
   }

   public static function GetLoginById($id)
   {
      global $db;
      $data = $db->query('SELECT login FROM users WHERE id = ?', Array($id));
      return $data[0]['login'];
   }

   public static function FindByLogin($login)
   {
      global $db;
      $data = $db->Query('SELECT id FROM users WHERE login = ?', Array($login));
      return new UserDB(!empty($data) ? $login : null);
   }

   public static function FindById($id)
   {
      global $db;
      $data = $db->query('SELECT login FROM users WHERE id = ?', Array($id));
      return new UserDB(!empty($data) ? $data[0]['login'] : null);
   }

   function __construct($login = false)
   {
      if (!$login) {
         $this->isExist = false;
         return;
      }
      global $db;
      $query = 'SELECT id, login, name, surname, teacher, phone, age, address, school, password, salt FROM users WHERE login = ?';
      $data = $db->Query($query, Array($login));
      $this->login = $login;
      $this->isExist = !empty($data);
      if (!$this->isExist) {
         return;
      }
      foreach ($data[0] as $attr => $value) {
         $this->$attr = $value;
      }
   }

   public function Update()
   {
      global $db;
      $query =
         'UPDATE users
         SET login = ?, name = ?, surname = ?, teacher = ?, phone = ?, age = ?, address = ?, school = ?, password = ?, salt = ?
         WHERE id = ?';
      $newValues = Array(
         $this->login,
         $this->name,
         $this->surname,
         $this->teacher,
         $this->phone,
         $this->age,
         $this->address,
         $this->school,
         $this->password,
         $this->salt,
         $this->id
      );
      $db->Query($query, $newValues, false);
   }

   public function Insert()
   {
      global $db;
      $query =
         'INSERT INTO users(login, name, surname, teacher, phone, age, address, school, password, salt)
         VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';
      $values = Array(
         $this->login,
         $this->name,
         $this->surname,
         $this->teacher,
         $this->phone,
         $this->age,
         $this->address,
         $this->school,
         $this->password,
         $this->salt
      );
      $db->Query($query, $values, false);
   }

   public function Delete()
   {
      global $db;
      $query = 'DELETE FROM users WHERE id = ?';
      $db->Query($query, Array($this->id));
   }

}

?>