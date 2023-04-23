<?php 
   use app\vendor\Controller;
   use app\models\User;
   use app\models\Product;

   class HomeController extends Controller
   {
      public function actionIndex()
      {
         // echo '<pre>';
         $name = 'Olex';

         $userModel = new User();
         $users = $userModel->getAll();
         // echo '<pre>';
         // var_dump($users);
         
         $productModel = new Product();
         $products = $productModel->getAllProducts();

         $this->view('home/index',
            [
               'name' => $name,
               'users' => $users,
               'products' => $products,
            ]
         );
      }
   }
?>