<?php 
   require_once 'app/vendor/Controller.php';
   require_once 'app/models/User.php';

   class AdminController extends Controller
   {      
      public function actionIndex()
      {
         if (isset($_SESSION['adminUser'])) {
            $this->render('admin/dashboard/index');
         } else {
            $this->actionLogin();
         }
      }

      public function actionRegister()
      {
         $userModel = new User();
         $userData = $this->getPost();
         if (!empty($userData)) {
            $userModel->save($userData);
            // $this->render('admin/login/login');
         } else {    // temporary
            // $this->render('admin/login/register');
         }
         $this->render('admin/login/register');
      }

      public function actionLogin()
      {
         $this->render('admin/login/login');
      }

      public function actionLogout()
      {
         $this->render('admin/login/logout');
      }
   }
?>