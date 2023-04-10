<?php 
   require_once "app/vendor/DataBase.php";
   require_once "app/vendor/BaseModel.php";

   echo '<pre>';

   class User extends BaseModel
   {
      // Витягнути інфу про 'users' і додати до неї суму замовлень з таблиці `orders`:
      public function getAllUsers()
      {
         $users = $this->getAll('users');

         foreach ($users as $user) {
            $builder = $this->builder();
            $stmt = $builder->prepare("SELECT * FROM shop_db.orders WHERE id_user = " . $user['id_user']);
            $stmt->execute();
            $orders[] = $stmt->fetch();
         }
         // var_dump($orders);

         foreach ($orders as $order) {
            if (!empty($order)) {
               $users[$order['id_user']]['total_price'] = $order['total_price'];
            }
         }
         // var_dump($users);
          
         return $users;
      }
   }

   // echo '</pre>';
?>