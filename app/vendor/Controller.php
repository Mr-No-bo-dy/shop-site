<?php 
   class Controller
   {
      public function __construct()
      {
         session_start();
      }

      // // Redirect to Views
      // protected function render(string $template, array $data = [])
      // {
      //    require_once 'app/resource/views/' . $template . '.php';
      // }

      // Redirect to Views
      protected function view(string $viewName, array $data = [])
      {
         $viewPath = 'app/resource/views/' . $viewName . '.php';
         if (file_exists($viewPath)) {
            extract($data, EXTR_OVERWRITE);
            include $viewPath;
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