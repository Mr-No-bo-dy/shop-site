<?php 
   require_once 'app/vendor/Controller.php';
   require_once 'app/vendor/DataBase.php';
   require_once 'app/models/Product.php';

   class HomeController extends Controller
   {
      public function actionIndex()
      {
         $name = 'Olex';
         $table = 'customers';
         $productModel = new Product();
         $products = $productModel->getAll($table);
         // $products = $productModel->getOne($table, 11);
         $this->render('home/index', 
            [
               'name' => $name,
               'products' => $products,
            ]
         );
      }
   }