<?php 
   namespace app\models;

   use app\vendor\BaseModel;

   class Order extends BaseModel
   {
      protected $dataBaseName = 'shop_db';
      public $table = 'orders';
      public $primaryKey = 'id_order';
      public $fields = ['id_order', 'id_user', 'id_customer', 'id_product', 'id_status', 'total_quantity', 'total_price'];
      
      // Витягнути інфу про 'orders', додати до неї всі необхідні дані з інших таблиць:
      public function getAllOrders(array $filters = [])
      {
         $sql = 'SELECT 
                  p.name AS product_name,
                  p.main_image AS product_image,
                  u.first_name AS user_first_name, 
                  u.last_name AS user_last_name, 
                  c.first_name AS customer_first_name, 
                  c.last_name AS customer_last_name, 
                  c.phone AS customer_phone, 
                  c.email AS customer_email, 
                  s.name AS order_status_name, 
                  s.category AS status_category, 
                  o.id_order, 
                  o.id_customer, 
                  o.id_user, 
                  o.id_product, 
                  o.id_status, 
                  o.total_quantity, 
                  o.total_price 
                  FROM ' . $this->dataBaseName . '.orders AS o
                  LEFT JOIN ' . $this->dataBaseName . '.products as p ON p.id_product = o.id_product
                  LEFT JOIN ' . $this->dataBaseName . '.statuses as s ON s.id_status = o.id_status
                  LEFT JOIN ' . $this->dataBaseName . '.users AS u ON u.id_user = o.id_user
                  LEFT JOIN ' . $this->dataBaseName . '.customers as c ON c.id_customer = o.id_customer';
         
         // FILTERS
         if (!empty($filters['productName'])) {
            $sql .=  $this->addFilter($sql) . 'p.name LIKE (\'%'. $filters['productName'] .'%\')';
         }
         if (!empty($filters['id_status'])) {
            $sql .=  $this->addFilter($sql) . 'o.id_status = '. $filters['id_status'] .'';
         }
         if (!empty($filters['id_customer'])) {
            $sql .=  $this->addFilter($sql) . 'o.id_customer = '. $filters['id_customer'] .'';
         }
         if (!empty($filters['id_user'])) {
            $sql .=  $this->addFilter($sql) . 'o.id_user = '. $filters['id_user'] .'';
         }

         $stmt = $this->builder()
                        ->query($sql);
         $orders = $stmt->fetchAll();

         $preparedOrders = [];
         foreach ($orders as $order) {
            $preparedOrders[$order['id_order']]['id_order'] = $order['id_order'];
            $preparedOrders[$order['id_order']]['id_status'] = $order['id_status'];
            $preparedOrders[$order['id_order']]['id_product'] = $order['id_product'];
            $preparedOrders[$order['id_order']]['product_name'] = $order['product_name'];
            $preparedOrders[$order['id_order']]['product_image'] = $order['product_image'];
            $preparedOrders[$order['id_order']]['total_quantity'] = $order['total_quantity'];
            $preparedOrders[$order['id_order']]['total_price'] = $order['total_price'];
            $preparedOrders[$order['id_order']]['order_status_name'] = $order['order_status_name'];
            $preparedOrders[$order['id_order']]['status_category'] = $order['status_category'];
            $preparedOrders[$order['id_order']]['id_user'] = $order['id_user'];
            $preparedOrders[$order['id_order']]['user_first_name'] = $order['user_first_name'];
            $preparedOrders[$order['id_order']]['user_last_name'] = $order['user_last_name'];
            $preparedOrders[$order['id_order']]['id_customer'] = $order['id_customer'];
            $preparedOrders[$order['id_order']]['customer_first_name'] = $order['customer_first_name'];
            $preparedOrders[$order['id_order']]['customer_last_name'] = $order['customer_last_name'];
            $preparedOrders[$order['id_order']]['customer_phone'] = $order['customer_phone'] ?? '' ;
            $preparedOrders[$order['id_order']]['customer_email'] = $order['customer_email'] ?? '' ;
         }

         return $preparedOrders;
      }
   }
?>