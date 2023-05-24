<?php 
   namespace app\models;

   use app\vendor\BaseModel;

   class Status extends BaseModel
   {
      protected $dataBaseName = 'shop_db';
      public $table = 'statuses';
      public $primaryKey = 'id_status';
      public $fields = ['id_status', 'name', 'category'];

   }
?>