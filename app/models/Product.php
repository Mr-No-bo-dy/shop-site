<?php 
   require_once "app/vendor/DataBase.php";
   require_once "app/vendor/BaseModel.php";

   // echo '<pre>';

   class Product extends BaseModel
   {
      // Витягнути інфу про 'products' і додати до неї ціни з таблиці `prices`:
      public function getAllProducts()
      {
         $products = $this->getAll('products');

         foreach ($products as $product) {
            $builder = $this->builder();
            $stmt = $builder->prepare("SELECT * FROM shop_db.prices WHERE id_product = " . $product['id_product'] . "");
            $stmt->execute();
            $prices[] = $stmt->fetch();
         }

         foreach ($prices as $price) {
            if (!empty($price)) {
               // $products[$price['id_product']]['price'] = $price['price'];
               foreach ($products as &$product) {
                  if ($price['id_product'] === $product['id_product']) {
                     // var_dump($price);
                     // var_dump($product);
                     $product['price'] = $price['price'];
                     // break;
                  }
               }
            }
         }
         // var_dump($products);
          
         return $products;
      }
   }
   
   // echo '</pre>';
?>