<?php 
   require_once 'app/vendor/DataBase.php';
   require_once 'app/vendor/BaseModel.php';
   // require_once 'app/helpers/Requires.php';

   // echo '<pre>';

   class User extends BaseModel
   {
      public function checkUser()
      {
         // if (isset($_POST['username'])) {
         //    $_SESSION['users']['adminLoginUser'] = $_POST['username'];
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