<?php 
   require_once 'app/vendor/Controller.php';
   // require_once 'app/vendor/DataBase.php';
   require_once 'app/models/Product.php';
   require_once 'app/models/User.php';
   require_once 'app/models/Customer.php';
   require_once 'app/models/Order.php';

   class RegisterController extends Controller
   {
      public function actionRegister()
      {
         $name = 'Olex';

         $productModel = new Product();
         $products = $productModel->getAllProducts();

         $userModel = new User();
         $users = $userModel->getAllUsers();

         $customerModel = new Customer();
         $customers = $customerModel->getAllCustomers();

         $orderModel = new Order();
         $orders = $orderModel->getAllOrders();

         $this->render('home/register', 
            [
               'name' => $name,
               'products' => $products,
               'users' => $users,
               'customers' => $customers,
               'orders' => $orders,
            ]
         );
      }
   }
?>