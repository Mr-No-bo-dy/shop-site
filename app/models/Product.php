<?php 
   namespace app\models;

   use app\vendor\BaseModel;

   class Product extends BaseModel
   {
      protected $dataBaseName = 'shop_db';
      public $table = 'products';
      public $primaryKey = 'id_product';
      public $fields = ['id_product', 'id_status', 'name', 'description', 'main_image', 'quantity'];

      // Витягнути інфу про 'products', додати до неї ціни з таблиці `prices` і статуси з таблиці `statuses`:
      public function getAllProducts()
      {

         $sql = 'SELECT prs.name AS product_status_name, 
                  ps.name AS price_status_name, 
                  -- pr.id_status AS product_status, 
                  p.id_status AS price_status, 
                  p.price, 
                  pr.id_product, 
                  pr.name, 
                  pr.description, 
                  pr.main_image, 
                  pr.quantity 
                  FROM ' . $this->dataBaseName . '.products AS pr
                  LEFT JOIN ' . $this->dataBaseName . '.statuses as prs ON prs.id_status = pr.id_status
                  LEFT JOIN ' . $this->dataBaseName . '.prices AS p ON pr.id_product = p.id_product
                  LEFT JOIN ' . $this->dataBaseName . '.statuses as ps ON ps.id_status = p.id_status';
         $stmt = $this->builder()
                  ->query($sql);
         $products = $stmt->fetchAll();

         $preparedProducts = [];
         foreach ($products as $product) {
            $preparedProducts[$product['id_product']]['id_product'] = $product['id_product'];
            $preparedProducts[$product['id_product']]['name'] = $product['name'];
            $preparedProducts[$product['id_product']]['description'] = $product['description'];
            $preparedProducts[$product['id_product']]['main_image'] = $product['main_image'];
            $preparedProducts[$product['id_product']]['quantity'] = $product['quantity'];
            // // product_status_name у мене в БД немає, тому поки закоментував цю колонку:
            // $preparedProducts[$product['id_product']]['product_status_name'] = $product['product_status_name'];
            // // price_status_name не використовую, тому поки закоментував цю колонку:
            // $preparedProducts[$product['id_product']]['prices'][$product['price_status']]['status'] = $product['price_status_name'];
            $preparedProducts[$product['id_product']]['prices'][$product['price_status']]['price'] = $product['price'];
         }
         // echo '<pre>';
         // var_dump($preparedProducts);
         // die;

         return $preparedProducts;
      }

      public function getOneProduct()
      {
         
      }
   }
?>