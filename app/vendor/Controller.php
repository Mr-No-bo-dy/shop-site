<?php 
   namespace app\vendor;

   class Controller
   {
      public function __construct()
      {
         // Start Session, if not started already
         if (session_status() === PHP_SESSION_NONE) {
            session_start();
         }

         // NOT allow anyone to get into Admin panel (except login- or register-page):
         $uri = explode('/', $_SERVER['REQUEST_URI']);
         if (session_status() != PHP_SESSION_NONE && !isset($_SESSION['user']['id_user']) && $uri[1] == 'admin' 
            && (isset($uri[2]) && $uri[2] != 'login')) {
            $this->view('admin/login/login');
            exit;
         }
      }

      public function redirect(string $url)
      {
         header('Location: ' . $url);
         exit;
      }

      // Create URL for routes
      public function getBaseURL(string $urlString = '') {
         $urlArray = explode('/', $_SERVER['REQUEST_URI']);
         $baseURL = '';
         for ($i = 1; $i < count($urlArray); $i++) {
            if ($urlArray[$i] === 'admin') {
               $baseURL .= '/admin/' . $urlString;
               break;
            } elseif ($urlArray[$i] === 'home') {
               $baseURL .= '/home/' . $urlString;
               break;
            } else {
               $baseURL .= '/' . $urlArray[$i];
            }
         }
         
         return $baseURL;
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
               if (isset($_POST[$key])) {
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
               if (isset($_GET[$key])) {
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
               if (isset($_FILES[$key])) {
                  $filesData = $_FILES[$key];
               } elseif (!isset($_FILES[$key])) {
                  $filesData = null;    // 'Error: undefined Files key ' . $key . '.';
               }
            }
         }

         return $filesData;
      }

      // Get data from $_SESSION
      public function getSession(string $key)
      {
         if(isset($_SESSION[$key]) && !empty($_SESSION[$key])) {
            return $_SESSION[$key];
         }
      }

      // Insert data into $_SESSION;
      public function setSession(mixed $data, mixed $value = null)
      {
         if (is_array($data)) {
            foreach ($data as $key => $val) {
               if (is_int($key)) {
                  $_SESSION[$val] = null;
               } else {
                  $_SESSION[$key] = $val;
               }
            }
            return;
         }

         $_SESSION[$data] = $value;
      }

      // unset $_SESSION[$resetKey]
      public function unsetSession(string $resetKey)
      {
         $reset = $this->getPost($resetKey);
         if (!empty($reset)) {
            unset($_SESSION[$resetKey]);
         }
      }

      // Logout from site
      public function actionLogout()
      {
         $this->view('home/login/logout');
      }
      
      // Simple handy var_dump
      static function dd($var)
      {
         echo '<pre>';
         var_dump($var);
         die;
      }
   }
?>