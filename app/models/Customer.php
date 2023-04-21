<?php 
   use app\vendor\BaseModel;

   // echo '<pre>';

   class Customer extends BaseModel
   {
      // public $table = 'users';
      // public $primaryKey = 'id_user';
      // public $fields = ['id_user', 'login', 'first_name', 'last_name', 'phone', 'id_status'];

      // Витягнути інфу про 'customers' і додати до неї суму замовлень з таблиці `orders`:
      public function getAllCustomers()
      {
         $customers = $this->getAll();

         foreach ($customers as $customer) {
            $builder = $this->builder();
            $stmt = $builder->prepare('SELECT * FROM shop_db.orders WHERE id_customer = ' . $customer['id_customer'] . '');
            $stmt->execute();
            $orders[] = $stmt->fetch();
         }

         foreach ($orders as $order) {
            if (!empty($order['total_price'])) {
               foreach ($customers as &$customer) {
                  if ($customer['id_customer'] === $order['id_customer']) {
                     $customer['total_price'] = $order['total_price'];
                  }
               }
            }
         }
          
         return $customers;
      }
   }

   // echo '</pre>';
?>