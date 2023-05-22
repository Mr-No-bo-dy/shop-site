<?php 
   namespace app\vendor;

   use ReflectionClass;
   use app\vendor\DataBase;

   class BaseModel
   {
      protected $properties = [];
      protected $dataBaseName = 'shop_db';

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
      
      public function builder()
      {
         return DataBase::connection();
      }

      // Get all info of all entities
      public function getAll(array $filters = [])
      {
         $table = $this->properties['table'];
         $primaryKey = $this->properties['primaryKey'];
         $fields = $this->properties['fields'];

         $builder = $this->builder();

         // Added filter for SQL-query
         $sqlFilters = '';
         if (!empty($filters)) {
            $sqlFilters = ' WHERE ' . key($filters) . ' IN (' . implode(', ', $filters[key($filters)]) . ')';
         }
         $stmt = $builder->prepare('SELECT ' . implode(', ', $fields) . ' FROM ' . $this->dataBaseName . '.' . $table . $sqlFilters . '');
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
         $stmt = $builder->prepare('SELECT ' . implode(', ', $fields) . ' FROM ' . $this->dataBaseName . '.' . $table . 
                                    ' WHERE ' . $primaryKey . ' = ' . $id . '');
         $stmt->execute();

         return $stmt->fetch();
      }
      
      // Insert entity into DB
      public function insert(array $data)
      {
         $table = $this->properties['table'];
         $primaryKey = $this->properties['primaryKey'];
         $fields = $this->properties['fields'];

         // Clean $fields from $primaryKey
         $fields = array_flip($fields);
         unset($fields[$primaryKey]);
         $fields = array_flip($fields);

         $dbFields = implode(', ', $fields);
         $postFields = ':' . implode(', :', $fields);

         $sql = 'INSERT INTO ' . $this->dataBaseName . '.' . $table . ' (' . $dbFields . ') 
                  VALUES (' . $postFields . ')';

         $this->builder()
               ->prepare($sql)
               ->execute($data);

         return $this->builder()->lastInsertId();
      }

      // Update entity in DB
      public function update(int $id, array $data)
      {
         $table = $this->properties['table'];
         $primaryKey = $this->properties['primaryKey'];

         $updateFields = '';
         foreach ($data as $key => $val) {
            $updateFields .= $key . "='" . $val . "',";
         }
         $updateFields = rtrim($updateFields, ', ');

         $sql = 'UPDATE ' . $this->dataBaseName . '.' . $table . ' SET ' . $updateFields . ' WHERE ' . $primaryKey . ' = ' . $id . '';

         $this->builder()
               ->prepare($sql)
               ->execute();
      }

      // Delete entity from DB
      public function delete($data, $field = null)
      {
         $table = $this->properties['table'];
         $primaryKey = $this->properties['primaryKey'];

         $fieldDelete = !is_null($field) ? $field : $primaryKey;
         if (!is_array($data)) {
            $sql = 'DELETE FROM ' . $this->dataBaseName . '.' . $table . ' WHERE ' . $fieldDelete . ' = ' . $data . '';
         } elseif (is_array($data)) {
            $sql = 'DELETE FROM ' . $this->dataBaseName . '.' . $table . ' WHERE ' . $fieldDelete . ' IN (' . implode(',', $data) . ')';
         }

         $this->builder()
               ->prepare($sql)
               ->execute();
      }
   }
?>