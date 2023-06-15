<?php 
   use app\vendor\Controller;
   use app\helpers\Request;
   use app\models\User;

   class AdminController extends Controller
   {
      public function actionRegister()
      {
         $request = new Request();
         $userModel = new User();

         $postData = $this->getPost();
         $data = [];
         if (!empty($postData)) {
            $errors = $request->checkUserRegister($postData);
            if (!empty($errors)) {
               $data['errors'] = $errors;
            } else {
               $userModel->saveUser($postData);
               
               return $this->view('admin/login/login');     // Перенаправить на Логін
               // return $this->actionLogin();                 // Відразу заЛогінить
            }
         }
         $this->view('admin/login/register', $data);
      }

      public function actionLogin()
      {
         // Якщо Адмін вже залогінений, - кидає на Логаут
         if (isset($_SESSION['user']['id_user'])) {
            header('Location: logout');
         }

         $userModel = new User();

         $postData = $this->getPost();
         $data = [];
         if (!empty($postData)) {
            $errors = $userModel->loginUser($postData);
            if (!empty($errors)) {
               $data['errors'] = $errors;
            } else {
               $data['user'] = $_SESSION['user'];
               
               return $this->actionIndex($data);
            }
         }
         $this->view('admin/login/login', $data);
      }
      
      public function actionIndex()
      {
         if (!isset($_SESSION['user']['id_user'])) {
            $this->actionLogin();
         } else {
            $this->view('admin/dashboard/index');
         }
      }

   }
?>