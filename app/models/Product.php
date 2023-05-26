<?php 
   namespace app\models;

   use app\vendor\BaseModel;

   class Product extends BaseModel
   {
      protected $dataBaseName = 'shop_db';
      public $table = 'products';
      public $primaryKey = 'id_product';
      public $fields = ['id_product', 'id_status', 'name', 'description', 'main_image', 'quantity'];

      // Витягнути інфу про 'products', додати до неї всі необхідні дані з інших таблиць:
      public function getAllProducts(array $filters = [])
      {
         $sql = 'SELECT pd.id_status AS product_status, 
                  pds.name AS product_status_name, 
                  p.id_status AS price_status, 
                  ps.name AS price_status_name, 
                  ppc.id_category, 
                  pc.name AS category_name, 
                  p.price, 
                  pd.id_product, 
                  pd.name, 
                  pd.description, 
                  pd.main_image, 
                  pd.quantity 
                  FROM ' . $this->dataBaseName . '.products AS pd
                  LEFT JOIN ' . $this->dataBaseName . '.statuses as pds ON pds.id_status = pd.id_status
                  LEFT JOIN ' . $this->dataBaseName . '.prices AS p ON pd.id_product = p.id_product
                  LEFT JOIN ' . $this->dataBaseName . '.statuses as ps ON ps.id_status = p.id_status
                  LEFT JOIN ' . $this->dataBaseName . '.products_categories as ppc ON ppc.id_product = pd.id_product
                  LEFT JOIN ' . $this->dataBaseName . '.categories as pc ON pc.id_category = ppc.id_category';
         if (!empty($filters['id_category'])) {
            $sql .= ' WHERE ppc.id_category = '. $filters['id_category'] .'';
         }
         
         $stmt = $this->builder()
                  ->query($sql);
         $products = $stmt->fetchAll();

         $preparedProducts = [];
         foreach ($products as $product) {
            $preparedProducts[$product['id_product']]['id_product'] = $product['id_product'];
            $preparedProducts[$product['id_product']]['name'] = $product['name'];
            $preparedProducts[$product['id_product']]['description'] = $product['description'];
            $preparedProducts[$product['id_product']]['status_name'] = $product['product_status_name'];
            $preparedProducts[$product['id_product']]['quantity'] = $product['quantity'];
            $preparedProducts[$product['id_product']]['main_image'] = $product['main_image'];
            $preparedProducts[$product['id_product']]['id_category'] = $product['id_category'] ?? '' ;
            $preparedProducts[$product['id_product']]['category_name'] = $product['category_name'] ?? '' ;
            $preparedProducts[$product['id_product']]['prices'][] = [$product['price_status_name'] => $product['price']] ?? '' ;
         }

         return $preparedProducts;
      }
   }
?>