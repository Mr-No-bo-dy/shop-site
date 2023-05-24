<?php 
   namespace app\models;

   use app\vendor\BaseModel;

   class Category extends BaseModel
   {
      protected $dataBaseName = 'shop_db';
      public $table = 'categories';
      public $primaryKey = 'id_category';
      public $fields = ['id_category', 'name', 'description'];

   }
?>