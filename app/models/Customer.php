<?php 
   require_once 'app/vendor/DataBase.php';
   require_once 'app/vendor/BaseModel.php';

   // echo '<pre>';

   class Customer extends BaseModel
   {
      // Витягнути інфу про 'customers' і додати до неї суму замовлень з таблиці `orders`:
      public function getAllCustomers()
      {
         $customers = $this->getAll('customers', 'id_customer');

         foreach ($customers as $customer) {
            $builder = $this->builder();
            $stmt = $builder->prepare('SELECT * FROM shop_db.orders WHERE id_customer = ' . $customer['id_customer'] . '');
            $stmt->execute();
            $orders[] = $stmt->fetch();
         }
         // var_dump($orders);

         foreach ($orders as $order) {
            if (!empty($order['total_price'])) {
               foreach ($customers as &$customer) {
                  if ($customer['id_customer'] === $order['id_customer']) {
                     $customer['total_price'] = $order['total_price'];
                  }
               }
            }
         }
         // var_dump($customers);
          
         return $customers;
      }
   }

   // echo '</pre>';
?>