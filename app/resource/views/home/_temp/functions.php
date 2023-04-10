<?php 
   // echo '<pre>';

   // Підключення файлу та виконання власне реєстрації:
   function registration($reg, array $userData = []) {
      require_once($reg . '.php');
   }

   // Читання з Файлу:
   function file_read($filename, $data = [], $mode = 'r') {
      $file = 'csv/' . $filename . '.csv';
      $streamR = fopen($file, $mode);
      while (($info = fgetcsv($streamR)) !== false) {
         $data[] = $info;
      }
      fclose($streamR);
      return $data;
   }

   // Запис в Файл:
   function file_write($filename, $data = [], $mode = 'a') {
      $file = 'csv/' . $filename . '.csv';
      $streamA = fopen($file, $mode);
      fputcsv($streamA, $data);
      fclose($streamA);
      return true;
   }

   // Перемішування масиву зі збереженням ключів:
   function shuffle_assoc(&$array) {
      $keys = array_keys($array);
      shuffle($keys);
      foreach($keys as $key) {
         $new[$key] = $array[$key];
      }
      $array = $new;
      return true;
   }

   // echo '</pre>';
?>