<?php 
   namespace app\helpers;

   use app\vendor\DataBase;
   use app\vendor\Controller;

   class Request
   {
      // Verification of all fields during user registration
      public function checkUserRegister(array $userData)
      {
         // echo '<pre>';
         $cont = new Controller;
         
         $userData = $cont->getPost();
         
         $errors = [];
         if (!empty($_POST)) {
            if (empty($userData['login']) || empty($userData['password']) || empty($userData['first_name']) || empty($userData['last_name']) 
               || empty($userData['phone']) || empty($userData['email']) || empty($userData['id_status'])) {
               $errors['all'] = 'Заповнені не всі поля';

            } else {
               // Get data from DB
               $pdo = new DataBase();
               $connection = $pdo->connection();
               $stmt = $connection->prepare('SELECT login, email, phone FROM shop_db.users');
               $stmt->execute();
               $db = $stmt->fetchAll();

               // Check login
               if (!preg_match_all('#[a-zA-Z0-9а-яА-ЯєЄіІ_-]{4,20}#u', $userData['login'])) {
                  $errors['login'] = 'Юзернейм повинен містити лише літери, цифри, - чи _ та мати довжину від 6 до 20 символів';
               }

               // Check unique login
               foreach ($db as $row) {
                  if ($userData['login'] == $row['login']) {
                     $errors['login'] = 'Такий Юзернейм вже зареєстрований';
                     break;
                  }
               }

               // Check password
               if (!preg_match_all('#[a-zA-Z0-9_-]{8,32}#u', $userData['password'])) {
                  $errors['password'] = 'Пароль повинен містити лише латинські літери, цифри, - чи _ та мати довжину від 8 до 32 символів';
               }

               // Check email
               if (preg_match('#(ru|rus)$#', $userData['email'])) {
                  $errors['email'] = 'Московитським окупантам тут не місце!';
               } elseif (!preg_match('#^[a-zA-Z0-9-.]+@[a-z]+\.[a-z]{2,3}$#', $userData['email'])) {
                  $errors['email'] = 'Такої електронної адреси не існує';
               }

               // Check unique email
               foreach ($db as $row) {
                  if ($userData['email'] == $row['email']) {
                     $errors['email'] = 'Така Електронна адреса вже зареєстрована';
                     break;
                  }
               }

               // Check phone
               if (preg_match('#^(7)#', $userData['phone'])) {
                  $errors['phone'] = 'Московитським окупантам тут не місце!';
               } elseif (!preg_match('#[0-9]{10,12}$#', $userData['phone'])) {
                  $errors['phone'] = 'Введіть номер телефону в міжнародному форматі без додаткових символів';
               }
               
               // Check first_name
               if (!preg_match_all('#[a-zA-Z0-9а-яА-ЯєЄіІ_-]{2,32}#u', $userData['first_name'])) {
                  $errors['first_name'] = 'Ім\'я повинно містити лише літери, цифри, - чи _ та мати довжину від 2 до 32 символів';
               }
               
               // Check last_name
               if (!preg_match_all('#[a-zA-Z0-9а-яА-ЯєЄіІ_-]{2,32}#u', $userData['last_name'])) {
                  $errors['last_name'] = 'Прізвище повинно містити лише літери, цифри, - чи _ та мати довжину від 2 до 32 символів';
               }
               
               // Check id_status
               if ((int)$userData['id_status'] != $userData['id_status']) {
                  $errors['id_status'] = 'Ідентифікатор статусу - це числове значення';
               }
            }
         }
         
         return $errors;
      }
   }
?>