<?php 
   namespace app\helpers;

   use app\vendor\DataBase;

   class Request
   {
      public function checkPost($postData)
      {
         $errors = [];
         foreach ($postData as $key => $val) {
            if (empty($val)) {
               $errors[$key]['check'] = true;
               $errors[$key]['desc'] = 'Це поле є обов\'язковим для заповнення';
            }
         }

         return $errors;
      }

      // Verification of all fields during user Registration
      public function checkUserRegister(array $postData)
      {
         $errors = $this->checkPost($postData);
         if (!empty($errors)) {
            return $errors;

         } else {
            // Get data from DB
            $pdo = new DataBase();

            $connection = $pdo->connection();
            $stmt = $connection->prepare('SELECT login, email, password FROM shop_db.users');
            $stmt->execute();
            $db = $stmt->fetchAll();

            // Check login
            if (!preg_match_all('#^(?!\s)[a-zA-Z0-9_-]{4,20}$#', $postData['login'])) {
               $errors['login']['check'] = true;
               $errors['login']['desc'] = 'Юзернейм повинен містити лише літери, цифри, - чи _ та мати довжину від 4 до 20 символів';
            }

            // Check unique login
            foreach ($db as $row) {
               if ($postData['login'] == $row['login']) {
                  $errors['login']['check'] = true;
                  $errors['login']['desc'] = 'Такий Юзернейм вже зареєстрований';
                  break;
               }
            }

            // Check password
            if (!preg_match_all('#^(?!\s)[a-zA-Z0-9_-]{8,32}$#', $postData['password'])) {
               $errors['password']['check'] = true;
               $errors['password']['desc'] = 'Пароль повинен містити лише латинські літери, цифри, - чи _ та мати довжину від 8 до 32 символів';
            }

            // Check email
            if (preg_match('#(ru|rus)$#', $postData['email'])) {
               $errors['email']['check'] = true;
               $errors['email']['desc'] = 'Московитським окупантам тут не місце!';
            } elseif (!preg_match('#^[a-zA-Z0-9-.]+@[a-z]+\.[a-z]{2,3}$#', $postData['email'])) {
               $errors['email']['check'] = true;
               $errors['email']['desc'] = 'Такої електронної адреси не існує';
            }

            // Check unique email
            foreach ($db as $row) {
               if ($postData['email'] == $row['email']) {
                  $errors['email']['check'] = true;
                  $errors['email']['desc'] = 'Така Електронна адреса вже зареєстрована';
                  break;
               }
            }

            // Check phone
            if (preg_match('#^7#', $postData['phone'])) {
               $errors['phone']['check'] = true;
               $errors['phone']['desc'] = 'Московитським окупантам тут не місце!';
            } elseif (!preg_match('#^[0-9]{10,12}$#', $postData['phone'])) {
               $errors['phone']['check'] = true;
               $errors['phone']['desc'] = 'Введіть номер телефону без ніяких додаткових символів';
            }
            
            // Check first_name
            if (!preg_match_all('#^[a-zA-Z0-9а-яА-ЯєЄіІ\s_-]{2,32}$#u', $postData['first_name'])) {
               $errors['first_name']['check'] = true;
               $errors['first_name']['desc'] = 'Ім\'я повинно містити лише літери, цифри, - чи _ та мати довжину від 2 до 32 символів';
            }
            
            // Check last_name
            if (!preg_match_all('#^[a-zA-Z0-9а-яА-ЯєЄіІ\s_-]{2,32}$#u', $postData['last_name'])) {
               $errors['last_name']['check'] = true;
               $errors['last_name']['desc'] = 'Прізвище повинно містити лише літери, цифри, - чи _ та мати довжину від 2 до 32 символів';
            }
            
            // Check id_status
            if ((int)$postData['id_status'] != $postData['id_status']) {
               $errors['id_status']['check'] = true;
               $errors['id_status']['desc'] = 'Ідентифікатор статусу - це числове значення';
            }
         }
         
         return $errors;
      }
   }
?>