<?php 
   use app\vendor\Controller;
   use app\models\Status;
   use app\models\User;

   class UserController extends Controller
   {
      public function actionIndex()
      {
         // $userModel = new User();
         // $statusModel = new Status();

         // $allUsers = $userModel->getallUsers();
         // $users = [];
         // foreach ($allUsers as $key => $user) {
         //    $status = $statusModel->getOne($user['id_status']);
         //    $users[$key]['id_user'] = $user['user']['id_user'];
         //    $users[$key]['login'] = $user['user']['login'];
         //    $users[$key]['email'] = $user['user']['email'];
         //    $users[$key]['phone'] = $user['user']['phone'];
         //    $users[$key]['first_name'] = $user['user']['first_name'];
         //    $users[$key]['last_name'] = $user['user']['last_name'];
         //    $users[$key]['status_name'] = $status['name'];
         //    $users[$key]['prices'] = $user['prices'];
         // }
         // // echo '<pre>';
         // // var_dump($allUsers);
         // // die;

         // $content = [
         //    'users' => $users,
         // ];
            
         // return $this->view('admin/user/index', $content);
      }
      
   }
?>