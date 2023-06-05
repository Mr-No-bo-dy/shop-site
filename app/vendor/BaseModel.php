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
      public function getAll(array $filters = [], array $options = [])
      {
         $table = $this->properties['table'];
         $primaryKey = $this->properties['primaryKey'];
         $fields = $this->properties['fields'];

         $builder = $this->builder();
         
         // Add option to get data from another related table
         $fieldKeys = key($filters);
         $preparedFields = implode(', ', $fields);
         if (!empty($options['table'])) {
            $table = $options['table'];
            $preparedFields = '*';
         }
         
         // Added filter for SQL-query
         $sqlFilters = '';
         if (!empty($filters)) {
            $sqlFilters = ' WHERE ' . $fieldKeys . ' IN (\'' . implode(', ', $filters[key($filters)]) . '\')';
         }
         $stmt = $builder->prepare('SELECT ' . $preparedFields . ' FROM ' . $this->dataBaseName . '.' . $table . $sqlFilters . '');
         $stmt->execute();

         $items = [];
         $result = $stmt->fetchAll();
         foreach ($result as $row) {
            $items[$row[$primaryKey]] = $row;
         }

         return $items;
      }

      // Get all info of one entity
      public function getOne(int $id, array $options = [])
      {
         $table = $this->properties['table'];
         $primaryKey = $this->properties['primaryKey'];
         $fields = $this->properties['fields'];

         $fieldsList = implode(', ', $fields);

         // Add option to get data from same table by value of another (not $primaryKey) column
         if (!empty($options['field'])) {
            $primaryKey = $options['field'];
         }
         // Add option to get data from another related table
         if (!empty($options['table'])) {
            $table = $options['table'];
            $fieldsList = '*';
         }

         $builder = $this->builder();
         $stmt = $builder->prepare('SELECT ' . $fieldsList . ' FROM ' . $this->dataBaseName . '.' . $table . 
                                    ' WHERE ' . $primaryKey . ' = ' . $id . '');
         $stmt->execute();

         return $stmt->fetch();
      }
      
      // Insert entity into DB
      public function insert(array $data, array $options = [])
      {
         $table = $this->properties['table'];
         $fields = $this->properties['fields'];

         $fields = [];
         foreach ($data as $key => $val) {
            $fields[] = $key;
         }
         $dbFields = implode(', ', $fields);
         $postFields = ':' . implode(', :', $fields);

         // Add option to get data from another related table
         if (!empty($options['table'])) {
            $table = $options['table'];
         }

         $sql = 'INSERT INTO ' . $this->dataBaseName . '.' . $table . ' (' . $dbFields . ') 
                  VALUES (' . $postFields . ')';

         $this->builder()
               ->prepare($sql)
               ->execute($data);

         return $this->builder()->lastInsertId();
      }

      // Update entity in DB
      public function update(int $id, array $data, array $options = [])
      {
         $table = $this->properties['table'];
         $primaryKey = $this->properties['primaryKey'];

         $updateFields = '';
         foreach ($data as $key => $val) {
            $updateFields .= $key . "='" . $val . "',";
         }
         $updateFields = rtrim($updateFields, ', ');

         // Add option to get data from same table by value of another (not $primaryKey) column
         if (!empty($options['field'])) {
            $primaryKey = $options['field'];
         }
         // Add option to get data from another related table
         if (!empty($options['table'])) {
            $table = $options['table'];
         }

         $sql = 'UPDATE ' . $this->dataBaseName . '.' . $table . ' SET ' . $updateFields . ' WHERE ' . $primaryKey . ' = ' . $id . '';

         $this->builder()
               ->prepare($sql)
               ->execute();
      }

      // Delete entity from DB
      public function delete($data, $options = [])
      {
         $table = $this->properties['table'];
         $primaryKey = $this->properties['primaryKey'];

         // Add option to get data from same table by value of another (not $primaryKey) column
         if (!empty($options['field'])) {
            $primaryKey = $options['field'];
         }
         // Add option to get data from another related table
         if (!empty($options['table'])) {
            $table = $options['table'];
         }

         if (!is_array($data)) {
            $sql = 'DELETE FROM ' . $this->dataBaseName . '.' . $table . ' WHERE ' . $primaryKey . ' = ' . $data . '';
         } elseif (is_array($data)) {
            $sql = 'DELETE FROM ' . $this->dataBaseName . '.' . $table . ' WHERE ' . $primaryKey . ' IN (' . implode(',', $data) . ')';
         }

         $this->builder()
               ->prepare($sql)
               ->execute();
      }

      // Add condition / filter KEYWORD to SQL Query
      public function addFilter(string $sql)
      {
         $sqlFilterAdd = '';
         if (str_contains($sql, 'WHERE')) {
            $sqlFilterAdd = ' AND ';
         } else {
            $sqlFilterAdd = ' WHERE ';
         }

         return $sqlFilterAdd;
      }

      // Simple handy var_dump
      static function dd($var)
      {
         echo '<pre>';
         var_dump($var);
         die;
      }
   }
?>