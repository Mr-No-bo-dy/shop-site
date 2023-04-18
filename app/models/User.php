<?php 
   require_once 'app/vendor/DataBase.php';
   require_once 'app/vendor/BaseModel.php';
   // require_once 'app/helpers/Requires.php';

   // echo '<pre>';

   class User extends BaseModel
   {
      // Add user into DB
      public function save(array $data)
      {
         if (isset($data['login']) && isset($data['password']) && isset($data['first_name']) && isset($data['last_name']) 
            && isset($data['phone']) && isset($data['email']) && isset($data['id_status'])) {
            
            $data = $this->errorRegister();
            
            $sql = 'INSERT INTO shop_db.users (login, password, first_name, last_name, phone, email, id_status) 
               VALUES (:login, :password, :first_name, :last_name, :phone, :email, :id_status)';
            
            // Password's hashing:
            $hashOptions = ['cost' => 12];
            $password = password_hash($data['password'], PASSWORD_BCRYPT, $hashOptions);

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

      public function login(array $data)
      {
         // echo '<pre>';
         session_destroy();
         try {
            $fieldsError = false;
            $errorText = '';

            // $cont = new Controller;
            // $userData = $cont->getPost();

            if (empty($data['login']) || empty($data['password'])) {
               $fieldsError = true;
               throw new Exception("Порожні поля");
            } else {

               // Get data from DB
               // $pdo = new DataBase();
               // $connection = $pdo->connection();
               $connection = $this->builder();
               $stmt = $connection->prepare('SELECT * FROM shop_db.users');
               $stmt->execute();
               $db = $stmt->fetchAll();
               
               $data['login'] = preg_replace('#[^a-zA-Z0-9а-яА-ЯєЄіІ_-]#u', '', $data['login']);
               $data['password'] = preg_replace('#[^a-zA-Z0-9а-яА-ЯєЄіІ_-]#u', '', $data['password']);

               foreach ($db as $row) {
                  if ($row['login'] == $data['login']) {
                     if (password_verify($data['password'], $row['password'])) {
                        $_SESSION['users']['admin'] = $data['login'];
                        return true;
                     } else {
                        throw new Exception("Неправильний Нікнейм або Пароль");
                     }
                  }
               }
            }

         } catch (Exception $e) {
            $errorText = $e->getMessage();
         }
      }
      
      public function checkUser()
      {
         // if (isset($_POST['username'])) {
         //    $_SESSION['users']['admin'] = $_POST['username'];
         //    header('Location: admin');
         // } else {
         //    // header('Location: login');
         // }
      }

      // Витягнути інфу про 'users' і додати до неї суму замовлень з таблиці `orders`:
      public function getAllUsers()
      {
         $users = $this->getAll('users', 'id_user');

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