<?php
   use app\helpers\Request;
   use app\vendor\Controller;
   use app\models\Product;
   use app\models\Category;
   use app\models\SubCategory;
   use app\models\Status;
   use app\models\Customer;
   use app\models\Order;

   class HomeController extends Controller
   {
      public function actionRegister()
      {
         $request = new Request();
         $customerModel = new Customer();

         $postData = $this->getPost();
         // $data = [];
         $data['title'] = 'Register';
         if (!empty($postData)) {
            $errors = $request->checkUserRegister($postData, 'customers');
            if (!empty($errors)) {
               $data['errors'] = $errors;
            } else {
               $customerModel->saveCustomer($postData);
               
               return $this->view('home/login/login');     // Перенаправить на Логін
               // return $this->actionLogin();                 // Відразу заЛогінить
            }
         }
         $this->view('home/login/register', $data);
      }

      public function actionLogin()
      {
         // Якщо Покупець вже залогінений, - кидає на Логаут
         if (isset($_SESSION['customer']['id_customer'])) {
            header('Location: logout');
         }

         $customerModel = new Customer();

         $postData = $this->getPost();
         // $data = [];
         $data['title'] = 'Login';
         if (!empty($postData)) {
            $errors = $customerModel->loginCustomer($postData);
            if (!empty($errors)) {
               $data['errors'] = $errors;
            } else {
               $data['customer'] = $_SESSION['customer'];
               
               return $this->actionIndex($data);
            }
         }
         $this->view('home/login/login', $data);
      }

      public function actionIndex()
      {
         $productModel = new Product();
         $categoryModel = new Category();
         $subCategoryModel = new SubCategory();
         $statusModel = new Status();

         // Формування фільтрів
         $filters = [
            'productName' => '',
            'id_category' => 0,
            'id_sub_category' => 0,
            'id_status' => 0,
            'price' => [],
         ];
         $productName = $this->getPost('productName');
         if (!empty($productName)) {
            $filters['productName'] = $productName;
         }
         $idCategory = $this->getPost('id_category');
         if (!empty($idCategory)) {
            $filters['id_category'] = $idCategory;
         }
         $idSubCategory = $this->getPost('id_sub_category');
         if (!empty($idSubCategory)) {
            $filters['id_sub_category'] = $idSubCategory;
         }
         $idStatus = $this->getPost('id_status');
         if (!empty($idStatus)) {
            $filters['id_status'] = $idStatus;
         }
         $price = $this->getPost('price');
         if (!empty($price)) {
            $filters['price'] = $price;
         }
         $resetFilters = $this->getPost('resetFilters');
         if (!empty($resetFilters)) {
            unset($_SESSION['filters']);
         }
         if (!empty($filters['productName']) || !empty($filters['id_category']) || !empty($filters['id_sub_category']) || !empty($filters['id_status']) || !empty($filters['price'])) {
            $this->setSession('filters', $filters);
         }
         if (!empty($_SESSION['filters'])) {
            $filters = array_merge($filters, $this->getSession('filters'));
         }

         // Витягування з БД даних і формування контенту на в'юшку
         $allProducts = $productModel->getAllProducts($filters);
         $allCategories = $categoryModel->getAll();
         $allSubCategories = $subCategoryModel->getAll();
         $allStatuses = $statusModel->getAll(['category' => ['product']]);
         $content = [
            'title' => 'Products ' . $filters['productName'] ?? '',
            'allProducts' => $allProducts,
            'allSubCategories' => array_merge([0 => ['id_sub_category' => 0, 'name' => 'All SubCategories']], $allSubCategories),
            'allCategories' => array_merge([0 => ['id_category' => 0, 'name' => 'All Categories']], $allCategories),
            'allStatuses' => array_merge([0 => ['id_status' => 0, 'name' => 'All Statuses']], $allStatuses),
            'filters' => $filters,
         ];

         // Формування Сесії для Кошика
         $userIP = $_SERVER['REMOTE_ADDR'];
         if (!isset($_SESSION['user'][$userIP]['cart'])) {
            $_SESSION['user'][$userIP]['cart'] = [];
         }
         $idProductCart = $this->getPost('cart');
         if (!empty($idProductCart)) {
            if (!isset($_SESSION['user'][$userIP]['cart'][$idProductCart]['count'])) {
               $_SESSION['user'][$userIP]['cart'][$idProductCart]['count'] = 0;
            }
            $_SESSION['user'][$userIP]['cart'][$idProductCart]['count']++;
         }

         $viewFile = '';
         if (empty($filters['productName']) && empty($filters['id_category']) && empty($filters['id_sub_category']) && empty($filters['id_status']) && empty($filters['price'])) {
            $viewFile = $this->view('home/index', $content);
         } else {
            $viewFile = $this->view('home/filtered', $content);
         }
         return $viewFile;
      }

      // Get Data for Cart
      public function actionCartData()
      {
         $productModel = new Product();
         
         $userIP = $_SERVER['REMOTE_ADDR'];
         if (!isset($_SESSION['user'][$userIP]['cart'])) {
            $_SESSION['user'][$userIP]['cart'] = [];
         }

         // Remove product from Cart
         $idRemoveCart = $this->getPost('remove_cart');
         if (!empty($idRemoveCart)) {
            unset($_SESSION['user'][$userIP]['cart'][$idRemoveCart]);
         }

         $productIDs = [];
         $productCounts = [];
         foreach ($_SESSION['user'][$userIP]['cart'] as $idProduct => $countArray) {
            $productIDs[$idProduct] = $idProduct;
            $productCounts[$idProduct] = $countArray['count'];
         }
         $filters = [
            'ids_product' => [],
         ];
         if (!empty($productIDs)) {
            $filters['ids_product'] = $productIDs;
         }
         if (!empty($filters['ids_product'])) {
            $cartProducts = $productModel->getAllProducts($filters);
            $cartData = [];
            foreach ($cartProducts as $idProduct => $product) {
               foreach ($productCounts as $idProductCount => $count) {
                  if ($idProduct === $idProductCount) {
                     $cartData[$idProduct]['id_product'] = $idProduct;
                     $cartData[$idProduct]['main_image'] = $product['main_image'];;
                     $cartData[$idProduct]['name'] = $product['name'];
                     $cartData[$idProduct]['count'] = $count;
                     $cartData[$idProduct]['price'] = $product['price'];
                     $cartData[$idProduct]['total_price'] = $count * $product['price'];
                  }
               }
            }
            $content = [
               'title' => 'Cart',
               'cartData' => $cartData,
            ];
         }

         return $content ?? [];
      }

      // Open Cart
      public function actionCart()
      {
         $cartData = $this->actionCartData();
         $viewFile = $this->view('home/cart', $cartData);

         return $viewFile;
      }

      // Create Order
      public function actionCreateOrder()
      {
         $cartData = $this->actionCartData();

         return $this->view('home/order', $cartData);
      }

      // Make Order
      public function actionOrder()
      {
         $customerModel = new Customer();
         $orderModel = new Order();

         $order = $this->getPost('order');
         if (!empty($order)) {
            $postData = $this->getPost();
            // Checking if customer already exists in DB and get existing customer's new data
            $isCustomerExist = $customerModel->getColumn('id_customer', ['email' => $postData['email']]);
            $existingCustomer = [];
            if ($isCustomerExist) {
               $existingCustomer = $customerModel->getOne($isCustomerExist);
               if ($existingCustomer['first_name'] != $postData['first_name']) {
                  $existingCustomer['new']['first_name'] = $postData['first_name'];
               }
               if ($existingCustomer['last_name'] != $postData['last_name']) {
                  $existingCustomer['new']['last_name'] = $postData['last_name'];
               }
               if ($existingCustomer['phone'] != $postData['phone']) {
                  $existingCustomer['new']['phone'] = $postData['phone'];
               }
            }

            // Update existing customer data, old data or create new customer
            $idCustomer = '';
            if (isset($existingCustomer['new'])) {
               $idCustomer = $existingCustomer['id_customer'];
               $customerModel->update($idCustomer, $existingCustomer['new']);
            } elseif (!empty($existingCustomer)) {
               $idCustomer = $existingCustomer['id_customer'];
            } else {
               $newCustomerIdStatus = $customerModel->getColumn('id_status', ['name' => 'customer_new'], 'statuses');
               $setCustomerData = [
                  'id_status' => $newCustomerIdStatus,
                  'first_name' => $postData['first_name'],
                  'last_name' => $postData['last_name'],
                  'phone' => $postData['phone'],
                  'email' => $postData['email'],
                  'login' => null,
               ];
               $idCustomer = $customerModel->insert($setCustomerData);
            }

            // Making Order itself
            if (!empty($idCustomer)) {
               $cartData = $this->actionCartData();
               $newOrderIdUserStatus = $customerModel->getColumn('id_status', ['name' => 'super_admin'], 'statuses');
               $newOrderIdUser = $customerModel->getColumn('id_user', ['id_status' => $newOrderIdUserStatus], 'users');
               $newOrderIdStatus = $customerModel->getColumn('id_status', ['name' => 'new_order'], 'statuses');
               foreach ($cartData as $cartProducts) {
                  foreach ($cartProducts as $idProduct => $product) {
                     $orderData = [
                        'id_user' => $newOrderIdUser,
                        'id_customer' => $idCustomer,
                        'id_product' => $idProduct,
                        'id_status' => $newOrderIdStatus,
                        'total_quantity' => $product['count'],
                        'total_price' => $product['total_price'],
                     ];
                     $orderModel->insert($orderData);
                     $userIP = $_SERVER['REMOTE_ADDR'];
                     unset($_SESSION['user'][$userIP]['cart']);
                  }
               }
            }

            return $this->view('templates/orderDone');
         }
      }
   }
?>