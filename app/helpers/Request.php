<?php 
   namespace app\helpers;

   use app\vendor\DataBase;

   class Request
   {
      // Verification of all fields during user Registration
      public function checkUserRegister(array $userData)
      {
         // echo '<pre>';
         
         $errors = [];
         if (!empty($_POST)) {
            if (empty($userData['login']) || empty($userData['password']) || empty($userData['first_name']) || empty($userData['last_name']) 
               || empty($userData['phone']) || empty($userData['email']) || empty($userData['id_status'])) {
               foreach ($userData as $key => $val) {
                  if (empty($val)) {
                     $errors[$key]['check'] = true;
                     $errors[$key]['desc'] = 'Це поле є обов\'язковим для заповнення';
                  }
               }

            } else {
               // Get data from DB
               $pdo = new DataBase();

               $connection = $pdo->connection();
               $stmt = $connection->prepare('SELECT login, email, password FROM shop_db.users');
               $stmt->execute();
               $db = $stmt->fetchAll();

               // Check login
               if (!preg_match_all('#^(?!\s)[a-zA-Z0-9а-яА-ЯєЄіІ_-]{4,20}$#u', $userData['login'])) {
                  $errors['login']['check'] = true;
                  $errors['login']['desc'] = 'Юзернейм повинен містити лише літери, цифри, - чи _ та мати довжину від 4 до 20 символів';
               }

               // Check unique login
               foreach ($db as $row) {
                  if ($userData['login'] == $row['login']) {
                     $errors['login']['check'] = true;
                     $errors['login']['desc'] = 'Такий Юзернейм вже зареєстрований';
                     break;
                  }
               }

               // Check password
               if (!preg_match_all('#[a-zA-Z0-9_-]{8,32}#u', $userData['password'])) {
                  $errors['password']['check'] = true;
                  $errors['password']['desc'] = 'Пароль повинен містити лише латинські літери, цифри, - чи _ та мати довжину від 8 до 32 символів';
               }

               // Check email
               if (preg_match('#(ru|rus)$#', $userData['email'])) {
                  $errors['email']['check'] = true;
                  $errors['email']['desc'] = 'Московитським окупантам тут не місце!';
               } elseif (!preg_match('#^[a-zA-Z0-9-.]+@[a-z]+\.[a-z]{2,3}$#', $userData['email'])) {
                  $errors['email']['check'] = true;
                  $errors['email']['desc'] = 'Такої електронної адреси не існує';
               }

               // Check unique email
               foreach ($db as $row) {
                  if ($userData['email'] == $row['email']) {
                     $errors['email']['check'] = true;
                     $errors['email']['desc'] = 'Така Електронна адреса вже зареєстрована';
                     break;
                  }
               }

               // Check phone
               if (preg_match('#^(7)#', $userData['phone'])) {
                  $errors['phone']['check'] = true;
                  $errors['phone']['desc'] = 'Московитським окупантам тут не місце!';
               } elseif (!preg_match('#[0-9]{10,12}$#', $userData['phone'])) {
                  $errors['phone']['check'] = true;
                  $errors['phone']['desc'] = 'Введіть номер телефону без ніяких додаткових символів';
               }
               
               // Check first_name
               if (!preg_match_all('#[a-zA-Z0-9а-яА-ЯєЄіІ_-]{2,32}#u', $userData['first_name'])) {
                  $errors['first_name']['check'] = true;
                  $errors['first_name']['desc'] = 'Ім\'я повинно містити лише літери, цифри, - чи _ та мати довжину від 2 до 32 символів';
               }
               
               // Check last_name
               if (!preg_match_all('#[a-zA-Z0-9а-яА-ЯєЄіІ_-]{2,32}#u', $userData['last_name'])) {
                  $errors['last_name']['check'] = true;
                  $errors['last_name']['desc'] = 'Прізвище повинно містити лише літери, цифри, - чи _ та мати довжину від 2 до 32 символів';
               }
               
               // Check id_status
               if ((int)$userData['id_status'] != $userData['id_status']) {
                  $errors['id_status']['check'] = true;
                  $errors['id_status']['desc'] = 'Ідентифікатор статусу - це числове значення';
               }
            }
         }
         
         return $errors;
      }

      // Verification of all fields during user Loginization
      public function checkUserLogin(array $userData)
      {
         // echo '<pre>';
         
         $errors = [];
         if (!empty($_POST)) {
            if (empty($userData['login']) || empty($userData['password'])) {
               foreach ($userData as $key => $val) {
                  if (empty($val)) {
                     $errors[$key]['check'] = true;
                     $errors[$key]['desc'] = 'Це поле є обов\'язковим для заповнення';
                  }
               }

            } else {
               // Get data from DB
               $pdo = new DataBase();

               $connection = $pdo->connection();
               $stmt = $connection->prepare('SELECT login, password FROM shop_db.users');
               $stmt->execute();
               $db = $stmt->fetchAll();

               // Check login
               if (!preg_match_all('#^(?!\s)[a-zA-Z0-9а-яА-ЯєЄіІ_-]{4,20}$#u', $userData['login'])) {
                  $errors['login']['check'] = true;
                  $errors['login']['desc'] = 'Юзернейм повинен містити лише літери, цифри, - чи _ та мати довжину від 4 до 20 символів';
               }

               // Check unique login
               foreach ($db as $row) {
                  if ($userData['login'] == $row['login']) {
                     $errors['login']['check'] = true;
                     $errors['login']['desc'] = 'Такий Юзернейм вже зареєстрований';
                     break;
                  }
               }

               // Check password
               if (!preg_match_all('#[a-zA-Z0-9_-]{8,32}#u', $userData['password'])) {
                  $errors['password']['check'] = true;
                  $errors['password']['desc'] = 'Пароль повинен містити лише латинські літери, цифри, - чи _ та мати довжину від 8 до 32 символів';
               }
            }
         }
         
         return $errors;
      }
   }
?>