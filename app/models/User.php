<?php 
   namespace app\models;

   use app\vendor\BaseModel;
   use Exception;

   class User extends BaseModel
   {
      public $table = 'users';
      public $primaryKey = 'id_user';
      public $fields = ['id_user', 'login', 'first_name', 'last_name', 'phone', 'id_status'];

      // Add user into DB
      public function saveUser(array $data)
      {
         if (isset($data['login']) && isset($data['password']) && isset($data['first_name']) && isset($data['last_name']) 
            && isset($data['phone']) && isset($data['email']) && isset($data['id_status'])) {
            
            $sql = 'INSERT INTO shop_db.users (login, password, first_name, last_name, phone, email, id_status) 
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
         // echo '<pre>';
         // try {
            // $fieldsError = false;
            // $errorText = '';

            $errors = [];
            if (empty($userData['login']) || empty($userData['password'])) {
               foreach ($userData as $key => $val) {
                  if (empty($val)) {
                     $errors[$key]['check'] = true;
                     $errors[$key]['desc'] = 'Це поле є обов\'язковим для заповнення';
                  }
               }
               // $fieldsError = true;
               // throw new Exception("Порожні поля");
            } else {

               // Get data from DB
               $connection = $this->builder();
               $stmt = $connection->prepare('SELECT login, password FROM shop_db.users');
               $stmt->execute();
               $db = $stmt->fetchAll();
               
               $userData['login'] = preg_replace('#[^a-zA-Z0-9а-яА-ЯєЄіІ_-]#u', '', $userData['login']);
               $userData['password'] = preg_replace('#[^a-zA-Z0-9а-яА-ЯєЄіІ_-]#u', '', $userData['password']);

               foreach ($db as $row) {
                  if ($row['login'] == $userData['login']) {
                     if (password_verify($userData['password'], $row['password'])) {
                        $_SESSION['users']['admin'] = $userData['login'];
                        // return true;
                     } else {
                        // return false;
                        $errors['login']['check'] = true;
                        $errors['password']['check'] = true;
                        $errors['login']['desc'] = 'Неправильний Нікнейм або Пароль';
                        $errors['password']['desc'] = 'Неправильний Нікнейм або Пароль';
                        // throw new Exception("Неправильний Нікнейм або Пароль");
                     }
                     // break;
                  // } else {
                  //    $errors['login']['check'] = true;
                  //    $errors['login']['desc'] = 'Такий користувач не зареєстрований';
                  }
               }
            }

         // } catch (Exception $e) {
         //    $errorText = $e->getMessage();
         // }
         return $errors;
      }

      // Витягнути інфу про 'users' і додати до неї суму замовлень з таблиці `orders`:
      public function getAllUsers()
      {
         $users = $this->getAll();

         foreach ($users as $user) {
            $builder = $this->builder();
            $stmt = $builder->prepare('SELECT * FROM shop_db.orders WHERE id_user = ' . $user['id_user'] . '');
            $stmt->execute();
            $orders[] = $stmt->fetch();
         }
         // var_dump($orders);


         foreach ($orders as $order) {
            if (!empty($order['total_price'])) {
               foreach ($users as &$user) {
                  if ($user['id_user'] === $order['id_user']) {
                     $user['total_price'] = $order['total_price'];
                  }
               }
            }
         }
         // var_dump($users);
          
         return $users;
      }
   }

   // echo '</pre>';
?>