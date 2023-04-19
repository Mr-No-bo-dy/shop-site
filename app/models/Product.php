<?php 
   require_once 'app/vendor/DataBase.php';
   require_once 'app/vendor/BaseModel.php';

   // echo '<pre>';

   class Product extends BaseModel
   {
      // Витягнути інфу про 'products' і додати до неї ціни з таблиці `prices`:
      public function getAllProducts()
      {
         $products = $this->getAll();

         $preparedProducts = [];
         foreach ($products as $product) {
            $builder = $this->builder();
            $stmt = $builder->prepare('SELECT * FROM shop_db.prices WHERE id_product = ' . $product['id_product'] . '');
            $stmt->execute();
            $prices[$product['id_product']] = $stmt->fetchAll();
         }
         
         foreach ($products as $product) {
            $preparedProducts[$product['id_product']]['product'] = $product;
            if ($prices[$product['id_product']]) {
               $preparedProducts[$product['id_product']]['prices'] = $prices[$product['id_product']];
            } else {
               $preparedProducts[$product['id_product']]['prices'] = [];
            }
         }

         return $preparedProducts;
      }
   }
   
   // echo '</pre>';
?>