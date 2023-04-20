<?php 
   require_once 'app/vendor/Controller.php';
   require_once 'app/models/User.php';

   class AdminController extends Controller
   {
      public function actionRegister()
      {
         $userModel = new User();
         $userData = $this->getPost();

         $request = new Request();
         $content = [];
         if (!empty($userData)) {
            $errors = $request->checkUserRegister($userData);
            if (!empty($errors)) {
               $content['errors'] = $errors;
            } else {
               $userModel->save($userData);
               // $this->actionLogin();
               header('Location: login');    // А чому так - з перенаправленням через routes?
            }
         } else {    // temporary
            $this->view('admin/login/register');
         }
      }

      public function actionLogin()
      {
         if (isset($_SESSION['users']['admin'])) {
            // $this->view('admin/dashboard/index');
            $this->actionIndex();
         } else {
            $userModel = new User();
            $userData = $this->getPost();
            // echo '<br> userData: <br>';
            // var_dump($userData);
            // die;
            if (!empty($userData['login']) && !empty($userData['password'])) {
               $login = $userModel->login($userData);
               if ($login) {
                  $this->actionIndex();
                  // $this->view('admin/dashboard/index');
               } else {
                  // $this->view('admin/login/login');
               }
               // header('Location: admin');
            } else {    // temporary
               // $this->view('admin/login/login');
               // echo '<h3>Error</h3>';
            }
            $this->view('admin/login/login');
         }
         echo '<br> SESSION: <br>';
         var_dump($_SESSION);
      }
      
      public function actionIndex()
      {
         if (isset($_SESSION['users']['admin'])) {
            $this->view('admin/dashboard/index');
         } else {
            $this->actionLogin();
         }
      }

      public function actionLogout()
      {
         $this->view('admin/login/logout');
      }
   }
?>