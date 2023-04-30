<?php 
   namespace app\vendor;

   use app\vendor\Controller;

   class Route
   {
      private $uri;           // Uniform Resource Identifier
      private $route;
      private $dirController = 'app/controllers/';   // dir with controllers
      private $controllerName = 'Index';
      private $actionName = 'Index';     // method in class 'controllerName'

      public function startApp()
      {
         $this->setUri();
         $this->setRoute();
         $this->setRouteParams();
         $this->redirect();
      }

      // Вибираємо те, що в нас в URL (Щоб перенаправляти по наших роутах на різні локації)
      public function setUri()
      {
         $this->uri = $_SERVER['REQUEST_URI'];
         $this->uri = trim($this->uri, '/');
      }

      // Розбиваємо на URL і get-параметри
      private function setRoute()
      {
         $this->route = explode('?', $this->uri);
      }

      // Налаштовуємо ім'я нашого Контроллера
      private function setControllerName($name)
      {
         $this->controllerName = ucfirst($name) . 'Controller';
      }

      // Налаштовуємо ім'я нашого Екшна
      private function setActionName($name)
      {
         $this->actionName = 'action' . ucfirst($name);
      }

      // Читанання наших Контроллерів і Екшнів
      private function setRouteParams()
      {
         global $urlRoutes;
         if (isset($urlRoutes[$this->route[0]])) {     // route[0] - ключ нашого масиву urlRoutes[]
            $routePath = explode('/', $urlRoutes[$this->route[0]]);
            if (isset($routePath[0]) && isset($routePath[1])) {
               $controllerName = $routePath[0];
               $actionName = $routePath[1];
               if ($routePath[0] == 'admin') {
                  $this->dirController .= 'admin/';
                  $controllerName = $routePath[1];
                  $actionName = $routePath[2];
               }
            }
            $this->setControllerName($controllerName);
            $this->setActionName($actionName);
         }
      }

      // Redirect to 404.php if URL is wrong: including Controller's file, creating Object & executing his method
      private function redirect()
      {
         $dir = $this->dirController . $this->controllerName . '.php';

         if (is_null($this->checkDirExist($dir))) {
            $controller = $this->checkClassExist($this->controllerName);
            if (!is_null($controller)) {
               $this->checkMethodExist($controller, $this->actionName);
            }
         }         
      }
      
      private function checkDirExist(string $dir)
      {
         $baseController = new Controller();
         $error = null;
         if (file_exists($dir)) {
            require_once($dir);
         } else {
            $error = 'This controller does NOT found.';
            $baseController->view('templates/404', ['error' => $error]);
         }

         return $error;
      }
      
      private function checkClassExist(string $controllerName)
      {
         $baseController = new Controller();
         // Просто створили дві різних пустих змінних:
         $error = $controller = null;
         if (class_exists($this->controllerName)) {
            $controller = new $this->controllerName();
         } else {
            $error = 'This class does NOT found.';
            $baseController->view('templates/404', ['error' => $error]);
         }

         return is_null($error) ? $controller : null;
      }
      
      private function checkMethodExist(object $controller, string $actionName)
      {
         $baseController = new Controller();
         $error = null;
         if (method_exists($controller, $actionName)) {
            $controller->$actionName();
         } else {
            $error = 'This action does NOT found.';
            $baseController->view('templates/404', ['error' => $error]);
         }
      }
   }
?>