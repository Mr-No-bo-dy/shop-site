<?php 
   use app\vendor\Controller;
   use app\models\User;
   // use app\models\Product;
   // use app\models\Status;

   class HomeController extends Controller
   {
      public function actionIndex()
      {
         $userModel = new User();
         $users = $userModel->getAll();
         
         // $productModel = new Product();
         // $products = $productModel->getAllProducts();
         
         // $statusModel = new Status();
         // $status = $statusModel->getOne(14);
         // echo '<pre>';
         // var_dump($status);
         // die;         

         $this->view('home/index',
            [
               'users' => $users,
               // 'status' => $status,
               // 'products' => $products,
            ]
         );
      }
   }
?>