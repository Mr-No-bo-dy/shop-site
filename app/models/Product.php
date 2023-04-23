<?php 
   namespace app\models;

   use app\vendor\BaseModel;
   use app\models\Price;

   class Product extends BaseModel
   {
      public $table = 'products';
      public $primaryKey = 'id_product';
      public $fields = ['id_product', 'id_status', 'name', 'description', 'main_image', 'quantity'];

      // Витягнути інфу про 'products' і додати до неї ціни з таблиці `prices`:
      public function getAllProducts()
      {
         $priceModel = new Price();

         $products = $this->getAll();
         $idsProduct = array_column($products, 'id_product');
         $prices = $priceModel->getAll(['id_product' => $idsProduct]);

         // // in Controller
         // $filters = [
         //    'name' => ''
         // ];
         // $search = 'search request';
         // if (!empty(getPost($_POST['search']))) {
         //    'name' => $_POST['search'];
         // }

         $preparedProducts = [];
         foreach ($products as $product) {
            $preparedProducts[$product['id_product']]['product'] = $product;
            if ($prices[$product['id_product']]) {
               $preparedProducts[$product['id_product']]['prices']['status'] = $prices[$product['id_product']]['id_status'];
               $preparedProducts[$product['id_product']]['prices']['price'] = $prices[$product['id_product']]['price'];
            } else {
               $preparedProducts[$product['id_product']]['prices']['price'] = [];
            }
         }

         return $preparedProducts;
      }
   }
?>