<?php 
   require_once "app/vendor/DataBase.php";

   echo '<pre>';

   class BaseModel
   {
      public function builder()
      {
         return DataBase::connection();
      }
      
      public function getAll($table)
      {
         $builder = $this->builder();
         $stmt = $builder->prepare("SELECT * FROM shop_db.$table");
         $stmt->execute();
         
         // // ПРАЦЮЄ, якщо PRIMARY KEY ЗАВЖДИ є 1-ю колонкою в таблиці:
         // while ($fetch = $stmt->fetch()) {
         //    // $items[reset($fetch)] = $fetch;
         //    $indexArray = array_values($fetch);
         //    $items[$indexArray[0]] = $fetch;
         // }
         // var_dump($items);

         // // Шукає, яка колона є PRIMARY KEY і записує всі результати запиту в 2D-масив із значенням PRIMARY KEY як ключ зовнішнього масиву:
         // $primaryColumnNum = '';
         // while ($row = $stmt->fetch()) {
         //    $allRows[] = $row;
         //    for ($i = 0; $i <= count($allRows); $i++) {
         //       // var_dump($allRows);
         //       $meta = $stmt->getColumnMeta($i);
         //       // var_dump($meta);
         //       if (isset($meta['flags'][1])) {
         //          // echo "<h2>It's primary key!</h2>";
         //          $primaryColumnNum = $i;
         //          break;
         //       }
         //    }
         //    $indexArray = array_values($row);
         //    // var_dump($indexArray);
         //    // var_dump($indexArray[$primaryColumnNum]);
         //    $items[$indexArray[$primaryColumnNum]] = $row;
         // }
         // // var_dump($allRows);
         // // var_dump($primaryColumnNum);
         // var_dump($items);

         // // Шукає, яка колона є PRIMARY KEY і записує всі результати запиту в 2D-масив із значенням PRIMARY KEY як ключ зовнішнього масиву:
         $rows = $stmt->fetchAll();
         // var_dump($rows);
         $primaryColumnNum = '';
         for ($i = 0; $i <= count($rows); $i++) {
            $meta = $stmt->getColumnMeta($i);
            // var_dump($meta);
            if (isset($meta['flags'][1])) {
               // echo "<h2>It's primary key!</h2>";
               $primaryColumnNum = $i;
               break;
            }
         }
         // var_dump($primaryColumnNum);
         foreach ($rows as $row) {
            $indexArray = array_values($row);
            $items[$indexArray[$primaryColumnNum]] = $row;
         }
         var_dump($items);

         return $items;
      }
      
      public function getOne($table, $id)
      {
         $builder = $this->builder();
         $stmt = $builder->prepare("SELECT * FROM shop_db.$table");
         $stmt->execute();

         // // ПРАЦЮЄ, якщо PRIMARY KEY ЗАВЖДИ є 1-ю колонкою в таблиці:
         // while ($fetch = $stmt->fetch()) {
         //    $indexArray = array_values($fetch);
         //    $items[$indexArray[0]] = $fetch;
         // }
         // $item = $items[$id];
         // var_dump($item);

         // // Шукає, яка колона є PRIMARY KEY і записує всі результати запиту в 2D-масив із значенням PRIMARY KEY як ключ зовнішнього масиву:
         // $primaryColumnNum = '';
         // while ($row = $stmt->fetch()) {
         //    $allRows[] = $row;
         //    for ($i = 0; $i <= count($allRows); $i++) {
         //       $meta = $stmt->getColumnMeta($i);
         //       if (isset($meta['flags'][1])) {
         //          $primaryColumnNum = $i;
         //          break;
         //       }
         //    }
         //    $indexArray = array_values($row);
         //    $items[$indexArray[$primaryColumnNum]] = $row;
         // }
         // $item = $items[$id];
         // var_dump($item);

         // Шукає, яка колона є PRIMARY KEY і записує всі результати запиту в 2D-масив із значенням PRIMARY KEY як ключ зовнішнього масиву:
         $rows = $stmt->fetchAll();
         $primaryColumnNum = '';
         for ($i = 0; $i <= count($rows); $i++) {
            $meta = $stmt->getColumnMeta($i);
            if (isset($meta['flags'][1])) {
               $primaryColumnNum = $i;
               break;
            }
         }
         foreach ($rows as $row) {
            $indexArray = array_values($row);
            $items[$indexArray[$primaryColumnNum]] = $row;
         }
         $item = $items[$id];
         var_dump($item);

         // $items = $this>getAll($table);
         // $item = $items[$id];

         return $item;
      }
   }
?>