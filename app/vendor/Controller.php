<?php 
   namespace app\vendor;

   class Controller
   {
      public function __construct()
      {
         if (session_status() === PHP_SESSION_NONE) {
            session_start();
         }
      }

      public function redirect(string $url)
      {
         header('Location: ' . $url);
         exit;
      }

      public function getBaseURL(string $string = '')
      {
         $url = explode('/', $_SERVER['REQUEST_URI']);
         if ($url[1] === 'admin') {
            $url[1] .= '/' . $string;
         }
         
         return !isset($url[2]) ? $url[1] : $string;
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

      // Return view-file of <img>
      public function getImage(array $data)
      {
         return $this->view('admin/components/image', $data);
      }

      // Get data from $_POST
      public function getPost(string $key = null)
      {
         $postData = [];
         if (isset($_POST)) {
            $postData = $_POST;
            if (!is_null($key)) {
               if (!empty($_POST[$key]) && isset($_POST[$key])) {
                  $postData = $_POST[$key];
               } elseif (!isset($_POST[$key])) {
                  $postData = null;    // 'Error: undefined POST key ' . $key . '.';
               }
            }
         }

         return $postData;
      }
      
      // Get data from $_GET
      public function getGet(string $key = null)
      {
         $getData = [];
         if (isset($_GET)) {
            $getData = $_GET;
            if (!is_null($key)) {
               if (!empty($_GET[$key]) && isset($_GET[$key])) {
                  $getData = $_GET[$key];
               } elseif (!isset($_GET[$key])) {
                  $getData = null;    // 'Error: undefined GET key ' . $key . '.';
               }
            }
         }

         return $getData;
      }

      // Get data from $_FILES
      public function getFiles(string $key = null)
      {
         $filesData = [];
         if (isset($_FILES)) {
            $filesData = $_FILES;
            if (!is_null($key)) {
               if (!empty($_FILES[$key]) && isset($_FILES[$key])) {
                  $filesData = $_FILES[$key];
               } elseif (!isset($_FILES[$key])) {
                  $filesData = null;    // 'Error: undefined Files key ' . $key . '.';
               }
            }
         }

         return $filesData;
      }

      public function actionLogout()
      {
         $this->view('home/logout');
      }
   }
?>