<?php 
   namespace app\vendor;

   class Controller
   {
      public function __construct()
      {
         if (session_status() == PHP_SESSION_NONE) {
            session_start();
         }
      }

      // Redirect to Views & import from array $data to variables
      public function view(string $viewName, array $data = [])
      {
         $viewPath = 'app/resource/views/' . $viewName . '.php';
         if (file_exists($viewPath)) {
            extract($data, EXTR_OVERWRITE);
            include $viewPath;
         } else {
            require_once 'app/resource/views/templates/404.php';
         }
      }

      // Get data from Post
      public function getPost(string $key = '')
      {
         $result = [];
         if (isset($_POST)) {
            $result = $_POST;
            if (!empty($_POST[$key])) {
               $result = $_POST[$key];
            }
         }
         return $result;
      }
   }
?>