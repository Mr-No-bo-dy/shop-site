<?php 
   echo '<pre>';
   try {
      $action = '';
      $fieldsError = false;
      $userUniqueError = false;
      $userEmailError = true;
      $userTelError = true;
      $errorText = '';
      if (!empty($_POST)) {
         if (empty($_POST['username']) || empty($_POST['password']) || empty($_POST['email']) || empty($_POST['tel'])) {
            $fieldsError = true;
            throw new Exception("Заповнені не всі поля");
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
            }

            // Перевірка на Унікальність:
            foreach ($usersData['users'] as $key => $val) {
               if ($key == $_POST['username']) {
                  $userUniqueError = true;
                  throw new Exception("Такий Юзернейм вже зареєстрований");
               }
            }

            // Перевірка Імейла:
            if (preg_match('#(ru|rus)$#', $_POST['email'])) {
               throw new Exception("Московитським окупантам тут не місце!");
            } elseif (!preg_match('#^[a-zA-Z0-9-.]+@[a-z]+\.[a-z]{2,3}$#', $_POST['email'])) {
               throw new Exception("Такої електронної адреси не існує");
            } else {
               $userEmailError = false;
            }

            // Перевірка Телефону:
            if (preg_match('#^(\+7)#', $_POST['tel'])) {
               throw new Exception("Московитським окупантам тут не місце!");
            } elseif (!preg_match('#^(\+)[0-9]{12}$#', $_POST['tel'])) {
               throw new Exception("Введіть номер телефону в міжнародному форматі без додаткових символів");
            } else {
               $userTelError = false;
            }

            $function_registrer = 'function_registrer';
            if (!$userUniqueError && !$userEmailError) {
               registration($function_registrer);
            }
         }
      }

   } catch (Exception $e) {
      $errorText = $e->getMessage();
   }
   echo '</pre>';
?>