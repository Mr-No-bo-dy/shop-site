<?php 
   use app\vendor\Controller;
   use app\models\Product;
   use app\models\Category;
   use app\models\SubCategory;
   use app\models\Status;
   use app\models\Customer;
   use app\models\Order;

   class HomeController extends Controller
   {
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
            // $_SESSION['user'][$userIP]['cart'][$idProductCart]['price'] = $allProducts[$idProductCart]['price'];
            // $_SESSION['user'][$userIP]['cart'][$idProductCart]['total_price'] = $allProducts[$idProductCart]['price'] * $_SESSION['user'][$userIP]['cart'][$idProductCart]['count'];
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
                  // if (array_key_exists($idProductCount, $cartProducts)) {
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
               'cartData' => $cartData,
            ];
         }

         return $content ?? false;
      }

      // Open Cart
      public function actionCart()
      {
         $cartData = $this->actionCartData();
         if (!empty($cartData)) {
            $viewFile = $this->view('home/cart', $cartData);
         } else {
            $viewFile = $this->view('templates/noCart');
         }

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
            $customerNew = $this->getPost();
            $customerData = [
               'id_status' => 13,
               'first_name' => $customerNew['first_name'],
               'last_name' => $customerNew['last_name'],
               'phone' => $customerNew['phone'],
               'email' => $customerNew['email'],
               'login' => null,
            ];
            // self::dd($customerData);
            $idCustomer = $customerModel->insert($customerData);
            if (!empty($idCustomer)) {
               $cartData = $this->actionCartData();
               foreach ($cartData as $cartProducts) {
                  foreach ($cartProducts as $idProduct => $product) {
                     $orderData = [
                        'id_user' => 1,
                        'id_customer' => $idCustomer,
                        'id_product' => $idProduct,
                        'id_status' => 65,
                        'total_quantity' => $product['count'],
                        'total_price' => $product['total_price'],
                     ];
                     $orderModel->insert($orderData);
                     $userIP = $_SERVER['REMOTE_ADDR'];
                     unset($_SESSION['user'][$userIP]['cart']);
                  }
               }
            }

            return $this->actionIndex();
         }
      }
   }
?>