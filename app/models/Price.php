<?php 
   namespace app\models;

   use app\vendor\BaseModel;

   class Price extends BaseModel
   {
      protected $dataBaseName = 'shop_db';
      public $table = 'prices';
      public $primaryKey = 'id_price';
      public $fields = ['id_price', 'id_product', 'id_status', 'price'];

   }
?>