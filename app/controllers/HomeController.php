<?php 
   require_once 'app/vendor/Controller.php';
   require_once 'app/vendor/DataBase.php';
   require_once 'app/models/Product.php';
   require_once 'app/models/User.php';
   require_once 'app/models/Customer.php';

   class HomeController extends Controller
   {
      public function actionIndex()
      {
         $name = 'Olex';

         // $table = 'products';
         // $tableSecondary = 'prices';
         $productModel = new Product();
         // $products = $productModel->getAll($table);
         // $product = $productModel->getOne($table, 11);
         $products = $productModel->getAllProducts();

         $userModel = new User();
         $users = $userModel->getAllUsers();

         $customerModel = new Customer();
         $customers = $customerModel->getAllCustomers();

         $this->render('home/index', 
            [
               'name' => $name,
               'products' => $products,
               'users' => $users,
               'customers' => $customers,
            ]
         );
      }
   }