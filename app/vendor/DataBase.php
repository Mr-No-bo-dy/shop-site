<?php 
   namespace app\vendor;

   use PDO;
   
   class DataBase
   {
      private static $connection;

      public static function connection()
      {
         // Умова: створювати нове з'єднання з БД, лише якщо його ще немає
         // (Для того, щоб і полегшити програму, і повертати останній введений в БД ID за допомогою lastInsertId() )
         if (empty(self::$connection)) {
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

            self::$connection = new PDO($dsn, $user, $password, $options);
         }
         
         return self::$connection;
      }
   }

?>