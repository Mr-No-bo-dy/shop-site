<?php 
   namespace app\models;

   use app\vendor\BaseModel;
   use app\models\Status;
   use app\models\Order;

   class User extends BaseModel
   {
      protected $dataBaseName = 'shop_db';
      public $table = 'users';
      public $primaryKey = 'id_user';
      public $fields = ['id_user', 'id_status', 'first_name', 'last_name', 'phone', 'email', 'login', 'password'];

      // Add user into DB
      public function saveUser(array $postData)
      {
         // Altering user's postData
         $postData['password'] = password_hash($postData['password'], PASSWORD_BCRYPT, ['cost' => 12]);
         $postData['last_name'] = ucfirst(trim($postData['last_name']));
         $postData['first_name'] = ucfirst(trim($postData['first_name']));

         $this->insert($postData);
      }

      public function loginUser(array $postData)
      {
         $errors = [];
         if (empty($postData['login']) || empty($postData['password'])) {
            foreach ($postData as $key => $val) {
               if (empty($val)) {
                  $errors[$key]['check'] = true;
                  $errors[$key]['desc'] = 'Це поле є обов\'язковим для заповнення';
               }
            }
         } else {
            // Чистка форм-інпутів:
            $postData['login'] = preg_replace('#[^a-zA-Z0-9_-]#', '', strip_tags($postData['login']));
            $postData['password'] = preg_replace('#[^a-zA-Z0-9_-]#', '', strip_tags($postData['password']));

            // Get data from DB
            $connection = $this->builder();
            $stmt = $connection->prepare('SELECT login FROM ' . $this->dataBaseName . '.users WHERE login = :login');
            $stmt->bindParam(':login', $postData['login']);
            $stmt->execute();
            $dbLogin = $stmt->fetchColumn();

            if ($postData['login'] == $dbLogin) {
               $stmt = $connection->prepare('SELECT password FROM ' . $this->dataBaseName . '.users WHERE login = :login');
               $stmt->bindParam(':login', $postData['login']);
               $stmt->execute();
               $dbPassword = $stmt->fetchColumn();
               if (password_verify($postData['password'], $dbPassword)) {
                  // Save user's ID into $_SESSION
                  $stmt = $connection->prepare('SELECT id_user FROM ' . $this->dataBaseName . '.users WHERE login = :login');
                  $stmt->bindParam(':login', $postData['login']);
                  $stmt->execute();
                  $dbIdUser = $stmt->fetchColumn();
                  $_SESSION['user']['id_user'] = $dbIdUser;
                  $_SESSION['user']['login'] = $dbLogin;
                  
               } else {
                  $errors['login']['check'] = true;
                  $errors['password']['check'] = true;
                  $errors['login_pass']['desc'] = 'Неправильний Нікнейм або Пароль';
               }
            } else {
               $errors['login']['check'] = true;
               $errors['password']['check'] = true;
               $errors['login_pass']['desc'] = 'Неправильний Нікнейм або Пароль';
            }
         }

         return $errors;
      }

      // // // Витягнути інфу про 'users' і додати до неї суму замовлень з таблиці `orders`:
      // public function getAllUsers()
      // {
      //    $orderModel = new Order();

      //    $users = $this->getAll();
      //    $idsUser = array_column($users, 'id_user');
      //    $orders = $orderModel->getAll(['id_user' => $idsUser]);
         
      //    $preparedUsers = [];
      //    foreach ($users as $user) {
      //       unset($user['password']);
      //       $preparedUsers[$user['id_user']] = $user;
      //       if ($orders[$user['id_user']]) {
      //           // таким чином НЕ виведе Замовлення з такими ж id, з якими id не існує юзерів
      //          $preparedUsers[$user['id_user']]['orders']['id_order'] = $orders[$user['id_user']]['id_order'];
      //          // echo '<pre>';
      //          // var_dump($orders[$user['id_user']]);
      //          // die;
      //          $preparedUsers[$user['id_user']]['orders']['total_price'] = $orders[$user['id_user']]['total_price'];
      //       } else {
      //          $preparedUsers[$user['id_user']]['orders']['total_price'] = [];
      //       }
      //    }
      //    return $preparedUsers;
      // }
      

      // // Витягнути інфу про 'users' і додати до неї суму замовлень з таблиці `orders`:
      // public function getAllUsers()
      // {
      //    $users = $this->getAll();

      //    foreach ($users as $user) {
      //       $builder = $this->builder();
      //       $stmt = $builder->prepare('SELECT total_price FROM ' . $this->dataBaseName . '.orders WHERE id_user = ' . $user['id_user'] . '');
      //       $stmt->execute();
      //       $orders[] = $stmt->fetch();
      //    }

      //    foreach ($orders as $order) {
      //       if (!empty($order['total_price'])) {
      //          foreach ($users as &$user) {
      //             if ($user['id_user'] === $order['id_user']) {
      //                $user['total_price'] = $order['total_price'];
      //             }
      //          }
      //       }
      //    }
          
      //    return $users;
      // }

   }
?>