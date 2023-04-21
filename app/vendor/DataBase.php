<?php 
   namespace app\vendor;

   use PDO;
   
   class DataBase
   {
      public static function connection()
      {
         $host = '127.0.0.1';
         $dbname = 'shop_db';
         $user = 'root';
         $password = '';
         $charset = 'utf8';

         $dsn = 'mysql:host' . $host . ';dbname' . $dbname . ';charter=' . $charset;
         $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
         ];
         
         return new PDO($dsn, $user, $password, $options);
      }
   }

?>