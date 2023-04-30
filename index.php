<?php 
   // Classes' Auto-Load (Авто-завантаження Класів):
   spl_autoload_register();
   require_once 'app/config/routes.php';

   // Створення об'єкту по неймспейсу замінює use namespace для даного класу
   $route = new app\vendor\Route();
   $route->startApp();

   // var_dump($_SERVER['REQUEST_URI']);
?>
