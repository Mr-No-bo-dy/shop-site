<?php 
   use app\vendor\Controller;
   use app\helpers\Request;
   use app\models\User;

   class AdminController extends Controller
   {      
      // public function __construct()
      // {
      //    if (!isset($_SESSION['user']['id_user']) && $_SERVER['REQUEST_URI'][0] == 'admin') {
      //       // $this->view('admin/login/login');
      //       // exit;
      //       $this->redirect('/app/resource/views/admin/login/login.php');
      //    }
      // }

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
         // Якщо Адмін вже залогінений адмін, - кидає на Логаут
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
      
      public function actionIndex(array $data = [])
      {
         if (!isset($_SESSION['user']['id_user'])) {
            $this->actionLogin();
         } else {
            $this->view('admin/dashboard/index', $data);
         }
      }

   }
?>