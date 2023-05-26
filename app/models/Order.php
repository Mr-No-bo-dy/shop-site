<?php 
   namespace app\models;

   use app\vendor\BaseModel;

   class Order extends BaseModel
   {
      protected $dataBaseName = 'shop_db';
      public $table = 'orders';
      public $primaryKey = 'id_order';
      public $fields = ['id_order', 'id_user', 'id_product', 'id_status', 'total_quantity', 'total_price'];
      
   }
?>