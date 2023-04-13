<?php 
   // echo '<pre>';

   // Classes' Auto-Load (Авто-завантаження Класів):
   spl_autoload_register();
   require_once 'app/config/routes.php';
   require_once 'app/vendor/Route.php';

   $route = new \vendor\Route();
   $route->startApp();

   // var_dump($_SERVER['REQUEST_URI']);

   // echo '</pre>';
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Document</title>
</head>

<body>


</body>

</html>
