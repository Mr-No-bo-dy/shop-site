<?php 
   namespace vendor;
   class Route
   {
      private $uri;           // Uniform Resource Identifier
      private $route;
      private $dirController = 'app/controllers/';   // dir with controllers
      private $controllerName = 'Index';
      private $actionName = 'Index';     // method in class "controllerName"

      public function startApp()
      {
         // var_dump($this->dirController);
         $this->setUri();
         $this->setRoute();
         $this->setRouteParams();
         $this->Redirect();
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
         if(isset($urlRoutes[$this->route[0]])) {     // route[0] - ключ нашого масиву urlRoutes[]
            $routePath = explode('/', $urlRoutes[$this->route[0]]);
            if (isset($routePath[0]) && isset($routePath[1])) {
               $this->setControllerName($routePath[0]);
               $this->setActionName($routePath[1]);
            }
         }
      }

      // Redirect if URL wrong (for Error 404): including Controller's file, creating Object & executing his method
      private function Redirect()
      {
         $dir = $this->dirController . $this->controllerName . '.php';
         if (file_exists($dir)) {
            require_once($dir);
         } else {
            die('Controller file does NOT found.');
         }

         if (class_exists($this->controllerName)) {
            $controller = new $this->controllerName();   // object creation of class (in file) "controllerName"
         } else {
            die('Class does NOT found.');
         }

         if (method_exists($controller, $this->actionName)) {
            $action = $this->actionName;
            $controller->$action();
         } else {
            die('Action does NOT found.');
         }
      }
   }
?>