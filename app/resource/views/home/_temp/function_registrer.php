<?php
   echo '<pre>';
   $userData = [];
   foreach ($_POST as $key => $val) {
      $userData[$key] = $val;
   }

   // Кодування паролю:
   $hashOptions = ['cost' => 12];
   $password = password_hash($userData['password'], PASSWORD_BCRYPT, $hashOptions);
   $userData['password'] = $password;
   
   // Завантаження файлу Аватари:
   $userData['avatar'] = '';
   if ($_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
      $uploads_dir = 'uploads';
      $type = explode('/', $_FILES['avatar']['type']);
      $tmp_name = $_FILES['avatar']['tmp_name'];
      $extension = $type[1];
      $fileName = $_POST['username'] . '.' . $extension;
      move_uploaded_file($tmp_name, $uploads_dir . '/' . $fileName);
      $userData['avatar'] = $fileName;
   }

   // Запис даних в .csv файл:
   $file = 'users';
   file_write($file, $userData);
   
   echo '</pre>';
   header("Location: login.php");
?>