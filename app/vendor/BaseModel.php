<?php 
   require_once "app/vendor/DataBase.php";

   class BaseModel
   {
      public function builder()
      {
         return DataBase::connection();
      }
   }
?>