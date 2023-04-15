<?php 
   require_once 'app/vendor/DataBase.php';

   class BaseModel
   {
      public function builder()
      {
         return DataBase::connection();
      }
      
      public function getAll(string $tableName, string $primaryColumnName)
      {
         $builder = $this->builder();
         $stmt = $builder->prepare('SELECT * FROM shop_db.' . $tableName . '');
         $stmt->execute();
         
         $items = [];
         $result = $stmt->fetchAll();
         foreach ($result as $row) {
            $items[$row[$primaryColumnName]] = $row;
         }

         return $items;
      }
      
      public function getOne(string $tableName, string $primaryColumnName, int $idEntity)
      {
         $builder = $this->builder();
         $stmt = $builder->prepare('SELECT * FROM shop_db.' .$tableName .' WHERE ' . $primaryColumnName .' = ' . $idEntity . '');
         $stmt->execute();
         $item = $stmt->fetch();

         return $item;
      }
   }
?>