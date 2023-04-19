<?php 
   require_once 'app/vendor/Controller.php';
   require_once 'app/models/User.php';

   class AdminController extends Controller
   {
      public function actionRegister()
      {
         $userModel = new User();
         $userData = $this->getPost();
         if (!empty($userData)) {
            $userModel->save($userData);
            // $this->view('admin/login/login');
            $this->actionLogin();
         } else {    // temporary
            $this->view('admin/login/register');
         }
      }

      public function actionLogin()
      {
         var_dump($_SESSION);
         $userModel = new User();
         $userData = $this->getPost();
         if (!empty($userData)) {
            $userModel->login($userData);
            // $this->view('admin/dashboard/index');
            $this->actionIndex();
         } else {    // temporary
            $this->view('admin/login/login');
         }
      }

      public function actionLogout()
      {
         $this->view('admin/login/logout');
      }
      
      public function actionIndex()
      {
         if (isset($_SESSION['users']['admin'])) {
            $this->view('admin/dashboard/index');
         } else {
            $this->actionLogin();
         }
      }
   }
?>