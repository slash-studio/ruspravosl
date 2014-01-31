<?php
   $uploaddir = 'uploads/';
   preg_match('/(.*)(\..*)/', basename($_FILES['uploadimage']['name']), $arr);
   $ext       = $arr[2];
   $filetypes = Array('.jpg', '.JPG', '.jpeg', '.JPEG');

   if (!in_array($ext, $filetypes)) {
      echo 'error';
   } else {
      try {
         require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/class.Image.php';
         $file = $_image->SetFieldByName('user_id', $_POST['user_id'])->SetFieldByName('category_id', $_POST['category_id'])->Insert(true);
         $path = $uploaddir . $file . '.jpg';
         if (move_uploaded_file($_FILES['uploadimage']['tmp_name'], $path)) {
            echo $file;
         } else {
            echo 'error';
         }
      } catch (DBException $e) {
         echo 'error';
      }
   }
?>