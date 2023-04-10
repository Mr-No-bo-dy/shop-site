<?php 
   require_once 'app/vendor/Controller.php';
   require_once 'app/vendor/DataBase.php';
   require_once 'app/models/Product.php';

   class RegisterController extends Controller
   {
      public function actionRegister()
      {
         $name = 'Olex';
         $table = 'customers';
         $productModel = new Product();
         $products = $productModel->getAll($table);
         // $products = $productModel->getOne($table, 11);
         $this->render('user/register', 
            [
               'name' => $name,
               'products' => $products,
            ]
         );
      }
   }