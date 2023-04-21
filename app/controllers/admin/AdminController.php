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
               echo '<pre>';
               var_dump($errors);
               die;
               $content['errors'] = $errors;
            } else {
               $userModel->saveUser($userData);
               $this->actionLogin();
            }
         } else {    // temporary
            $this->view('admin/login/register');
         }
      }

      public function actionLogin()
      {
         $userModel = new User();
         $userData = $this->getPost();
         if (!empty($userData['login']) && !empty($userData['password'])) {
            $login = $userModel->login($userData);
            if ($login) {
               header('Location: admin');
            }
         }
         $this->view('admin/login/login');
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