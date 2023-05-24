<?php 
   namespace app\models;

   use app\vendor\BaseModel;

   class SubCategory extends BaseModel
   {
      protected $dataBaseName = 'shop_db';
      public $table = 'sub_categories';
      public $primaryKey = 'id_sub_category';
      public $fields = ['id_sub_category', 'id_category', 'name', 'description'];

   }
?>