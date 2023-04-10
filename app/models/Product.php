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
            $stmt = $builder->prepare("SELECT * FROM shop_db.prices WHERE id_product = " . $product['id_product']);
            $stmt->execute();
            $prices[] = $stmt->fetch();
         }

         foreach ($prices as $price) {
            if (!empty($price)) {
               $products[$price['id_product']]['price'] = $price['price'];
            }
         }
         // var_dump($products);
          
         return $products;
      }
   }
   
   // echo '</pre>';
?>