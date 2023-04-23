<?php 
   namespace app\models;

   use app\vendor\BaseModel;

   class User extends BaseModel
   {
      protected $dataBaseName = 'shop_db';
      public $table = 'users';
      public $primaryKey = 'id_user';
      public $fields = ['id_user', 'login', 'first_name', 'last_name', 'phone', 'id_status'];

      // Add user into DB
      public function saveUser(array $data)
      {
         if (isset($data['login']) && isset($data['password']) && isset($data['first_name']) && isset($data['last_name']) 
            && isset($data['phone']) && isset($data['email']) && isset($data['id_status'])) {
            
            $sql = 'INSERT INTO ' . $this->dataBaseName . '.users (login, password, first_name, last_name, phone, email, id_status) 
               VALUES (:login, :password, :first_name, :last_name, :phone, :email, :id_status)';
            
            // Password's hashing:
            $hashOptions = ['cost' => 12];
            $password = password_hash($data['password'], PASSWORD_BCRYPT, $hashOptions);

            $data['last_name'] = ucfirst($data['last_name']);
            $data['first_name'] = ucfirst($data['first_name']);

            $stmt = $this->builder()
                        ->prepare($sql);

            $stmt->bindParam(':login', $data['login']);
            $stmt->bindParam(':password', $password);
            $stmt->bindParam(':first_name', $data['first_name']);
            $stmt->bindParam(':last_name', $data['last_name']);
            $stmt->bindParam(':phone', $data['phone']);
            $stmt->bindParam(':email', $data['email']);
            $stmt->bindParam(':id_status', $data['id_status']);
            $stmt->execute();
         }
      }

      public function login(array $userData)
      {
         $errors = [];
         if (empty($userData['login']) || empty($userData['password'])) {
            foreach ($userData as $key => $val) {
               if (empty($val)) {
                  $errors[$key]['check'] = true;
                  $errors[$key]['desc'] = 'Це поле є обов\'язковим для заповнення';
               }
            }

         } else {
            // Очистка форм-інпутів:
            $userData['login'] = preg_replace('#[^a-zA-Z0-9_-]#', '', strip_tags($userData['login']));
            $userData['password'] = preg_replace('#[^a-zA-Z0-9_-]#', '', strip_tags($userData['password']));

            // Get data from DB
            $connection = $this->builder();
            $stmt = $connection->prepare('SELECT login FROM ' . $this->dataBaseName . '.users WHERE login = :login');
            $stmt->bindParam(':login', $userData['login']);
            $stmt->execute();
            $dbLogin = $stmt->fetchColumn();

            if ($userData['login'] == $dbLogin) {
               $stmt = $connection->prepare('SELECT password FROM ' . $this->dataBaseName . '.users WHERE login = :login');
               $stmt->bindParam(':login', $userData['login']);
               $stmt->execute();
               $dbPassword = $stmt->fetchColumn();
               if (password_verify($userData['password'], $dbPassword)) {
                  $_SESSION['users']['admin'] = 'admin';
               } else {
                  // $errors['login']['check'] = true;
                  // $errors['password']['check'] = true;
                  $errors['login_pass']['desc'] = 'Неправильний Нікнейм або Пароль';
               }
            } else {
               // $errors['login']['check'] = true;
               // $errors['password']['check'] = true;
               $errors['login_pass']['desc'] = 'Неправильний Нікнейм або Пароль';
            }
         }

         return $errors;
      }

      // Витягнути інфу про 'users' і додати до неї суму замовлень з таблиці `orders`:
      public function getAllUsers()
      {
         $users = $this->getAll();

         foreach ($users as $user) {
            $builder = $this->builder();
            $stmt = $builder->prepare('SELECT total_price FROM ' . $this->dataBaseName . '.orders WHERE id_user = ' . $user['id_user'] . '');
            $stmt->execute();
            $orders[] = $stmt->fetch();
         }

         foreach ($orders as $order) {
            if (!empty($order['total_price'])) {
               foreach ($users as &$user) {
                  if ($user['id_user'] === $order['id_user']) {
                     $user['total_price'] = $order['total_price'];
                  }
               }
            }
         }
          
         return $users;
      }
   }
?>