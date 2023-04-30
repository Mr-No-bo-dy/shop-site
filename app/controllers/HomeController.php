<?php 
   use app\vendor\Controller;
   use app\helpers\Request;
   use app\models\Product;

   class HomeController extends Controller
   {
      public function actionIndex()
      {
         $name = 'Olex';

         // $userModel = new User();
         // $users = $userModel->getAll();
         
         $productModel = new Product();
         $products = $productModel->getAllProducts();
         // echo '<pre>';
         // var_dump($products);
         // die;

         $this->view('home/index',
            [
               'name' => $name,
               // 'users' => $users,
               'products' => $products,
            ]
         );
      }
   }
?>