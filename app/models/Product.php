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
                  p.id_price, 
                  p.id_status AS price_status, 
                  ps.name AS price_status_name, 
                  p.active, 
                  c.id_category, 
                  c.name AS category_name, 
                  sc.id_sub_category, 
                  sc.name AS sub_category_name, 
                  p.price, 
                  pd.id_product, 
                  pd.name, 
                  pd.description, 
                  pd.main_image, 
                  pd.quantity 
                  FROM ' . $this->dataBaseName . '.products AS pd
                  LEFT JOIN ' . $this->dataBaseName . '.statuses as pds ON pds.id_status = pd.id_status
                  LEFT JOIN ' . $this->dataBaseName . '.prices AS p ON p.id_product = pd.id_product
                  LEFT JOIN ' . $this->dataBaseName . '.statuses as ps ON ps.id_status = p.id_status
                  LEFT JOIN ' . $this->dataBaseName . '.products_categories as pc ON pc.id_product = pd.id_product
                  LEFT JOIN ' . $this->dataBaseName . '.categories as c ON c.id_category = pc.id_category
                  LEFT JOIN ' . $this->dataBaseName . '.sub_categories as sc ON sc.id_category = c.id_category';
         
         // FILTERS
         if (!empty($filters['productName'])) {
            $sql .=  $this->addFilter($sql) . 'pd.name LIKE (\'%'. $filters['productName'] .'%\')';
         }
         if (!empty($filters['id_category'])) {
            $sql .=  $this->addFilter($sql) . 'c.id_category = '. $filters['id_category'] .'';
         }
         if (!empty($filters['id_sub_category'])) {
            $sql .=  $this->addFilter($sql) . 'sc.id_sub_category = '. $filters['id_sub_category'] .'';
         }
         if (!empty($filters['id_status'])) {
            $sql .=  $this->addFilter($sql) . 'pd.id_status = '. $filters['id_status'] .'';
         }
         if (!empty($filters['price'])) {
            if (!empty($filters['price']['min'])) {
               $sql .=  $this->addFilter($sql) . 'p.price >= '. $filters['price']['min'] .'';
            }
            if (!empty($filters['price']['max'])) {
               $sql .=  $this->addFilter($sql) . 'p.price <= '. $filters['price']['max'] .'';
            }
         }
         // This filter is for site's Cart
         if (!empty($filters['ids_product'])) {
            $sql .=  ' WHERE pd.id_product IN ('. implode(',', $filters['ids_product']) .')';
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
            $preparedProducts[$product['id_product']]['sub_categories'][$product['id_sub_category']] = $product['sub_category_name'] ?? '' ;
            $preparedProducts[$product['id_product']]['prices'][$product['id_price']] = [$product['price_status_name'] => $product['price']] ?? '' ;
            if ($product['active']) {
               $preparedProducts[$product['id_product']]['price'] = $product['price'];
            } elseif (!isset($preparedProducts[$product['id_product']]['price'])) {
               $preparedProducts[$product['id_product']]['price'] = '';
            }
         }

         return $preparedProducts;
      }
   }
?>