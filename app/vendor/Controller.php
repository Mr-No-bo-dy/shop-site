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
      
      public function getValue()    // -> в констракт. Якщо нема - на логін.
      {
         // if (isset($_SESSION['users']['admin'])) {
         //    // header('Location: app/resource/views/admin/dashboard/index.php');
         //    // header('Location: admin');
         // } else {
         //    // header('Location: app/resource/views/admin/register/login.php');
         //    header('Location: login');
         // }
      }  
         
      public function setValue()
      {
         // $_SESSION['users']['admin'] = $userData['login'];
      }

   }
?>