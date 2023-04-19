<?php 
   require_once 'app/vendor/Controller.php';
   require_once 'app/models/User.php';

   class HomeController extends Controller
   {
      public function actionIndex()
      {
         // echo '<pre>';
         $name = 'Olex';

         $userModel = new User();
         $users = $userModel->getAll();
         // var_dump($users);
         // $users = $userModel->getAllUsers();

         $this->view('home/index',
            [
               'name' => $name,
               'users' => $users,
            ]
         );
      }
   }
?>