<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/connect.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/class.Texts.php';

if ($contest_status != 1) {
  header('Location: /');
}

if (isset($_POST['submit'])) {
   $post    = array_map('strip_tags', array_map('trim', $_POST));
   $pass    = $post['pass'];
   $repass  = $post['pass_rep'];
   $_SESSION['regInfo'] = Array(
      'login'   => $login   = $post['login'],
      'name'    => $name    = $post['name'],
      'school'  => $school  = $post['school'],
      'surname' => $surname = $post['surname'],
      'teacher' => $teacher = $post['teacher'],
      'phone'   => $phone   = $post['phone'],
      'age'     => $age     = $post['age'],
      'address' => $address = $post['address']
    );
   try {
      $data_h->validateForm($post)
             ->validateLogin($login)
             ->validatePositiveNum($age)
             ->validateRepeatPasswords($pass, $repass)
             ->validatePassword($pass)
             ->validatePhone($phone)
             ->validateAge($age);
      Registration::Register($login, $pass, $name, $surname, $teacher, $phone, $age, $address, $school, $lastContest['contest_id']);
      unset($_SESSION['regInfo']);
      header("Location: /success_reg");
   } catch (Exception $e) {
      $errorMsg = $e->getMessage();
   }
}
$smarty->assign('regInfo',  isset($_SESSION['regInfo']) ? $_SESSION['regInfo'] : null)
       ->assign('errorMsg', isset($errorMsg) ? $errorMsg : false)
       ->assign('text', $_texts->GetById(REGISTER_TEXT_ID))
       ->display('registration.tpl');
?>