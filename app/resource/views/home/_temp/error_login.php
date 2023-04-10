<?php 
   echo '<pre>';
   try {
      $action = '';
      $fieldsError = false;
      $userLoginError = true;
      $errorText = '';
      $admin = 'mrnobody';
      if (!empty($_POST)) {
         if (empty($_POST['username']) || empty($_POST['password'])) {
            $fieldsError = true;
            throw new Exception("Порожні поля");
         } else {
            // Читання простої 'БД' Юзерів:
            $file = 'users';
            $users = file_read($file);
            
            // Формування асоціативної 'БД' Юзерів:
            $usersData = [];
            foreach ($users as $row) {
               $usersData['users'][$row[0]]['username'] = $row[0];
               $usersData['users'][$row[0]]['password'] = $row[1];
               $usersData['users'][$row[0]]['email'] = $row[2];
               $usersData['users'][$row[0]]['tel'] = $row[3];
               $usersData['users'][$row[0]]['avatar'] = $row[4];

               // Перевірка Юзернейма і Пароля:
               if ($usersData['users'][$row[0]]['username'] == $_POST['username']) {
                  if (password_verify($_POST['password'], $usersData['users'][$row[0]]['password'])) {      // Перевірка закодованого паролю
                     $userLoginError = false;
                     session_destroy();      // Очистка Сесії
                     session_start();
                     // Якщо Адмін - запис даних ВСІХ юзерів в Сесію і перенаправлення в "Адмінку":
                     if ($_POST['username'] == $admin) {
                        foreach ($users as $row) {
                           if ($_POST['username'] == $row[0]) {
                              $_SESSION['users']['admin']['username'] = $_POST['username'];
                              $_SESSION['users']['admin']['email'] = $usersData['users'][$_POST['username']]['email'];
                              $_SESSION['users']['admin']['tel'] = $usersData['users'][$_POST['username']]['tel'];
                              $_SESSION['users']['admin']['avatar'] = $usersData['users'][$_POST['username']]['avatar'];
                           } else {
                              $_SESSION['users'][$row[0]]['username'] = $row[0];
                              $_SESSION['users'][$row[0]]['email'] = $row[2];
                              $_SESSION['users'][$row[0]]['tel'] = $row[3];
                              $_SESSION['users'][$row[0]]['avatar'] = $row[4];
                           }
                        }
                        header('Location: admin.php');
                        
                     } else {
                        // Якщо не адмін - запис даних поточного Юзера в Сесію і перенаправлення на Головну:
                        $_SESSION['users']['user']['username'] = $_POST['username'];
                        $_SESSION['users']['user']['email'] = $usersData['users'][$_POST['username']]['email'];
                        $_SESSION['users']['user']['tel'] = $usersData['users'][$_POST['username']]['tel'];
                        $_SESSION['users']['user']['avatar'] = $usersData['users'][$_POST['username']]['avatar'];
                        header('Location: index.php');
                     }
                  } else {
                     throw new Exception("Неправильний Нікнейм або Пароль");
                  }
               }
            }
         }
      }
   } catch (Exception $e) {
      $errorText = $e->getMessage();
   }
   
   echo '</pre>';
?>