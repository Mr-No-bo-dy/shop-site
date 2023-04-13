<?php 
   require_once "app/vendor/DataBase.php";

   // echo '<pre>';

   class BaseModel
   {
      public function builder()
      {
         return DataBase::connection();
      }
      
      public function getAll(string $table_name, string $primary_column_name)
      {
         $builder = $this->builder();
         $stmt = $builder->prepare('SELECT * FROM shop_db.' . $table_name . '');
         $stmt->execute();
         
         $items = [];
         $result = $stmt->fetchAll();
         foreach ($result as $row) {
            $items[$row[$primary_column_name]] = $row;
         }

         return $items;
      }
      
      public function getOne(string $table_name, string $primary_column_name, int $id_entity)
      {
         $builder = $this->builder();
         $stmt = $builder->prepare('SELECT * FROM shop_db.' .$table_name .' WHERE ' . $primary_column_name .' = ' . $id_entity . '');
         $stmt->execute();
         $item = $stmt->fetch();

         return $item;
      }
   }

   // echo '</pre>';
?>