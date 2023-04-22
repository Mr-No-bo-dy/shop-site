<?php 
   use app\models\User;
   use app\vendor\Controller;
   use app\helpers\Request;

   class AdminController extends Controller
   {
      public function actionRegister()
      {
         $userModel = new User();
         $request = new Request();

         $userData = $this->getPost();
         $content = [];
         if (!empty($userData)) {
            $errors = $request->checkUserRegister($userData);
            if (!empty($errors)) {
               $content['errors'] = $errors;
            } else {
               $userModel->saveUser($userData);
               header('Location: login');
            }
         }
         $this->view('admin/login/register', $content);

      }

      public function actionLogin()
      {
         // Перенаправлення в адмінку, якщо адмін вже залогінений
         if (isset($_SESSION['users']['admin'])) {
            header('Location: admin');
         }

         $userModel = new User();

         $userData = $this->getPost();
         $content = [];
         if (!empty($userData)) {
            $errors = $userModel->login($userData);
            if (!empty($errors)) {
               $content['errors'] = $errors;
            } else {
               header('Location: admin');
            }
         }
         $this->view('admin/login/login', $content);
      }
      
      public function actionIndex()
      {
         if (!isset($_SESSION['users']['admin'])) {
            $this->actionLogin();
         }
         $this->view('admin/dashboard/index');
      }

      public function actionLogout()
      {
         $this->view('admin/login/logout');
      }
   }
?>