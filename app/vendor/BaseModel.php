<?php 
   namespace app\vendor;

   use ReflectionClass;
   use app\vendor\DataBase;

   class BaseModel
   {
      protected $properties = [];

      public function builder()
      {
         return DataBase::connection();
      }

      public function __construct()
      {
         $this->getChildProperties($this->getInheritedClassName());
      }

      public function getInheritedClassName()
      {
         return get_called_class();
      }

      // Get properties of Child Class
      public function getChildProperties($childModel)
      {
         $reflection = new ReflectionClass($childModel);
         $properties = $reflection->getProperties();
         foreach ($properties as $property) {
            $this->properties[$property->getName()] = $property->getValue($this);
         }
      }
      
      // Get all info of all entities
      public function getAll(array $filters = [])
      {
         $table = $this->properties['table'];
         $primaryKey = $this->properties['primaryKey'];
         $fields = $this->properties['fields'];

         $builder = $this->builder();
         $stmt = $builder->prepare('SELECT ' . implode(', ', $fields) . ' FROM shop_db.' . $table . '');
         $stmt->execute();

         $items = [];
         $result = $stmt->fetchAll();
         foreach ($result as $row) {
            $items[$row[$primaryKey]] = $row;
         }

         return $items;
      }
      
      // Get all info of one entity
      public function getOne(int $id)
      {
         $table = $this->properties['table'];
         $primaryKey = $this->properties['primaryKey'];
         $fields = $this->properties['fields'];

         $builder = $this->builder();
         $stmt = $builder->prepare('SELECT ' . implode(', ', $fields) . ' FROM shop_db.' . $table . ' WHERE ' . $primaryKey . ' = ' . $id . '');
         $stmt->execute();

         return $stmt->fetch();
      }
   }
?>