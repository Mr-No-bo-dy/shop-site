<?php 
   namespace app\models;

   use app\vendor\BaseModel;

   class ProductCategory extends BaseModel
   {
      protected $dataBaseName = 'shop_db';
      public $table = 'products_categories';
      public $primaryKey = 'id_product_category';
      public $fields = ['id_product_category', 'id_category', 'id_product '];

   }
?>