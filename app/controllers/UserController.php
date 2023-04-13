<?php 
   require_once 'app/vendor/Controller.php';

   class UserController extends Controller
   {
      public function actionRegister()
      {
         $this->render('admin/register/register', 
            [
               
            ]
         );
      }

      public function actionLogin()
      {
         $this->render('admin/register/login', 
            [
               
            ]
         );
      }

      public function actionLogout()
      {
         $this->render('admin/register/logout', 
            [
               
            ]
         );
      }
   }
?>