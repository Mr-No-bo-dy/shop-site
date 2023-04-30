<?php 
   namespace app\models;

   use app\vendor\BaseModel;

   class Price extends BaseModel
   {
      // protected $dataBaseName = 'shop_db';
      public $table = 'prices';
      public $primaryKey = 'id_price';
      public $fields = ['id_price', 'id_product', 'id_status', 'price'];

      // Витягнути інфу про 'products' і додати до неї ціни з таблиці `prices`:
      public function getAllPrices()
      {

      }
   }
?>