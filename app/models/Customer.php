<?php 
   namespace app\models;
   
   use app\vendor\BaseModel;

   class Customer extends BaseModel
   {
      protected $dataBaseName = 'shop_db';
      public $table = 'customers';
      public $primaryKey = 'id_customer';
      public $fields = ['id_customer', 'id_status', 'first_name', 'last_name', 'phone', 'email', 'login'];
      
   }
?>