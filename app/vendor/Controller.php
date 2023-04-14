<?php 
   class Controller
   {
      public function __construct()
      {
         session_start();
      }

      protected function render(string $template, array $data = [])
      {
         require_once 'app/resource/views/' . $template . '.php';
      }

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