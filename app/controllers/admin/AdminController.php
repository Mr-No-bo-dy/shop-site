<?php 
   use app\vendor\Controller;
   use app\helpers\Request;
   use app\models\User;

   class AdminController extends Controller
   {      
      // public function __construct()
      // {
      //    if (!isset($_SESSION['users']['admin']) && $_SERVER['REQUEST_URI'][0] == 'admin') {
      //       $this->view('admin/login/login');
      //       exit;
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
               $data['user'] = $postData;
               $userModel->saveUser($postData);
               
               return $this->view('admin/login/login', $data);    // Перенаправить на Логін із заповненими даними
               // return $this->actionLogin();                       // Відразу заЛогінить
            }
         }
         $this->view('admin/login/register', $data);
      }

      public function actionLogin()
      {
         // Логаут, якщо  вже залогінений адмін, заходить на логін
         if (isset($_SESSION['users']['admin'])) {
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
               $data['user'] = $postData;
               // $idUser = $_SESSION['id_user']; // і потім перевірки логінізації по $idUser. І цей id передавати на в'юшки
               
               return $this->actionIndex($data);
            }
         }
         $this->view('admin/login/login', $data);
      }
      
      public function actionIndex(array $data = [])
      {
         if (!isset($_SESSION['users']['admin'])) {
            $this->actionLogin();
         } else {
            $this->view('admin/dashboard/index', $data);
         }
      }

   }
?>