<?php 
   require_once 'app/vendor/Controller.php';
   require_once 'app/vendor/DataBase.php';
   require_once 'app/models/Product.php';

   class HomeController extends Controller
   {
      public function actionIndex()
      {
         $name = 'Olex';
         $productModel = new Product();
         $products = $productModel->getAllProducts();
         $this->render('home/index', 
            [
               'name' => $name,
               'products' => $products,
            ]
         );
      }
   }