<?php 
   require_once "app/vendor/DataBase.php";
   require_once "app/vendor/BaseModel.php";

   // echo '<pre>';

   class Order extends BaseModel
   {
      // Витягнути інфу про 'orders' і додати до неї ціни з таблиці `products`:
      public function getAllOrders()
      {
         $orders = $this->getAll('orders');

         foreach ($orders as $order) {
            $builder = $this->builder();
            $stmt = $builder->prepare("SELECT * FROM shop_db.products WHERE id_product = " . $order['id_product'] . "");
            $stmt->execute();
            $products[] = $stmt->fetch();
         }

         foreach ($products as $product) {
            foreach ($orders as &$order) {
               if ($order['id_product'] == $product['id_product']) {
                  // var_dump($order);
                  // var_dump($product);
                  // echo '<h4>idp</h4>';
                  $order['name'] = $product['name'];
                  // $orders[$order['id_product']]['name'] = $product['name'];
                  // var_dump($order);
                  // $orders[] = $order['name'];
                  // break;
               }
            }
         }
         // var_dump($orders);

         // foreach ($orders as $order) {
         //    $builder = $this->builder();
         //    $stmt = $builder->prepare("SELECT * FROM shop_db.products WHERE id_product = " . $order['id_product']);
         //    $stmt->execute();
         //    $products[] = $stmt->fetch();
         // }

          
         return $orders;
      }
   }
   
   // echo '</pre>';
?>