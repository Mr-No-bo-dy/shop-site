<?php 
   use app\vendor\BaseModel;

   // echo '<pre>';

   class Order extends BaseModel
   {
      // public $table = 'orders';
      // public $primaryKey = 'id_order';
      // public $fields = ['id_order', 'id_user', 'id_product', 'id_status', 'total_quantity', 'total_price'];

      // Витягнути інфу про 'orders' і додати до неї ціни з таблиці `products`:
      public function getAllOrders()
      {
         $orders = $this->getAll();

         foreach ($orders as $order) {
            $builder = $this->builder();
            $stmt = $builder->prepare('SELECT * FROM shop_db.products WHERE id_product = ' . $order['id_product'] . '');
            $stmt->execute();
            $products[] = $stmt->fetch();
         }

         foreach ($products as $product) {
            foreach ($orders as &$order) {
               if ($order['id_product'] == $product['id_product']) {
                  $order['name'] = $product['name'];
               }
            }
         }
          
         return $orders;
      }
   }
   
   // echo '</pre>';
?>