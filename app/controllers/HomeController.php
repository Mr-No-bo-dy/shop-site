<?php 
   use app\vendor\Controller;
   use app\models\User;

   class HomeController extends Controller
   {
      public function actionIndex()
      {
         $userModel = new User();
         $users = $userModel->getAll();

         $this->view('home/index',
            [
               'users' => $users,
            ]
         );
      }
   }
?>