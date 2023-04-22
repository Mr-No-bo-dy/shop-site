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
               // $this->actionLogin();
               header('Location: login');
            }
         // } else {    // temporary
         //    $this->view('admin/login/register');
         }
         $this->view('admin/login/register', $content);

      }

      public function actionLogin()
      {
         // Чи треба з екшнЛогіна перенаправляти в адмінку, якщо адмін вже залогінений?
         if (isset($_SESSION['users']['admin'])) {
            header('Location: admin');
         }

         $userModel = new User();
         // $request = new Request();

         $userData = $this->getPost();
         $content = [];
         if (!empty($userData)) {
            $errors = $userModel->login($userData);
            // echo '<pre>';
            // var_dump($errors);
            // die;
            if (!empty($errors)) {
               $content['errors'] = $errors;
            } else {
               // $login = $userModel->login($userData);
               // if ($login) {
                  header('Location: admin');
               // }
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