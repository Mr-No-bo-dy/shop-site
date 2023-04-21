<?php 
   use app\vendor\BaseModel;

   // echo '<pre>';

   class Product extends BaseModel
   {
      // public $table = 'products';
      // public $primaryKey = 'id_product';
      // public $fields = ['id_product', 'name', '	description', 'main_image', '	quantity'];

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