<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/connect.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/class.DataHandling.php';

class UserDB
{
   public
      $id;

   public
      $age        = '',
      $salt       = '',
      $name       = '',
      $phone      = '',
      $login      = '',
      $school     = '',
      $surname    = '',
      $teacher    = '',
      $address    = '',
      $password   = '',
      $contest_id = '';

   public $isExist = false;

   public static function FindByLogin($login, $contest_id)
   {
      global $db;
      $data = $db->Query('SELECT id FROM users WHERE login = ? AND contest_id = ?', Array($login, $contest_id));
      return new UserDB(!empty($data) ? $login : null, $contest_id);
   }

   public static function FindById($id)
   {
      global $db;
      $data = $db->query('SELECT login, contest_id FROM users WHERE id = ?', Array($id));
      return new UserDB(!empty($data) ? $data[0]['login'] : null, !empty($data)? $data[0]['contest_id'] : null);
   }

   function __construct($login = false, $contest_id)
   {
      if (!$login) {
         $this->isExist = false;
         return;
      }
      global $db;
      $query = 'SELECT id, login, name, surname, teacher, phone, age, address, school, password, salt, contest_id FROM users WHERE login = ? AND contest_id = ?';
      $data = $db->Query($query, Array($login, $contest_id));
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
         SET login = ?, name = ?, surname = ?, teacher = ?, phone = ?, age = ?, address = ?, school = ?, password = ?, salt = ?, contest_id = ?
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
         $this->contest_id,
         $this->id
      );
      $db->Query($query, $newValues, false);
   }

   public function Insert()
   {
      global $db;
      $query =
         'INSERT INTO users(login, name, surname, teacher, phone, age, address, school, password, salt, contest_id)
         VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';
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
         $this->salt,
         $this->contest_id
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