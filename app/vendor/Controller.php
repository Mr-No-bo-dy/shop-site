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

      public function redirect(string $url)
      {
         header('Location: ' . $url);
         exit;
      }

      // Redirect to Views & import from array $data to variables
      public function view(string $viewName, array $data = [])
      {
         $viewPath = 'app/resource/views/' . $viewName . '.php';
         if (file_exists($viewPath)) {
            extract($data, EXTR_OVERWRITE);
            include $viewPath;
         }
      }

      // Get data from Post
      public function getPost(string $key = null)
      {
         $postData = [];
         if (isset($_POST)) {
            $postData = $_POST;
            if (!is_null($key)) {
               // if (!empty($_POST[$key])) {
               if (!empty($_POST[$key]) && isset($_POST[$key])) {
                  $postData = $_POST[$key];
               } elseif (!isset($_POST[$key])) {
                  $postData = 'Error: undefined POST key ' . $key . '.';
               }
            }
         }
         return $postData;
      }
      
      public function actionLogout()
      {
         $this->view('home/logout');
      }
   }
?>