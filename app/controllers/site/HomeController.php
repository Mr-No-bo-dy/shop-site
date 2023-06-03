<?php 
   use app\vendor\Controller;
   use app\models\Product;   
   use app\models\Category;
   use app\models\SubCategory;
   use app\models\Status;

   class HomeController extends Controller
   {
      public function actionIndex()
      {
         $productModel = new Product();
         $categoryModel = new Category();
         $subCategoryModel = new SubCategory();
         $statusModel = new Status();

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

         $products = $productModel->getAllProducts($filters);
         $allCategories = $categoryModel->getAll();
         $allSubCategories = $subCategoryModel->getAll();
         $allStatuses = $statusModel->getAll(['category' => ['product']]);

         $content = [
            'products' => $products,
            'allSubCategories' => array_merge([0 => ['id_sub_category' => 0, 'name' => 'All SubCategories']], $allSubCategories),
            'allCategories' => array_merge([0 => ['id_category' => 0, 'name' => 'All Categories']], $allCategories),
            'allStatuses' => array_merge([0 => ['id_status' => 0, 'name' => 'All Statuses']], $allStatuses),
            'filters' => $filters,
         ];

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

         // echo '<pre>';
         // var_dump($_SESSION['user'][$userIP]['cart']);
         // die;
         
         $viewFile = '';
         if (empty($filters['productName']) && empty($filters['id_category']) && empty($filters['id_sub_category']) && empty($filters['id_status']) && empty($filters['price'])) {
            $viewFile = $this->view('home/index', $content);
         } else {
            $viewFile = $this->view('home/view', $content);
         }
         return $viewFile;
      }

      public function actionCart()
      {
         $productModel = new Product();

         $userIP = $_SERVER['REMOTE_ADDR'];
         if (!isset($_SESSION['user'][$userIP]['cart'])) {
            $_SESSION['user'][$userIP]['cart'] = [];
         }
         $idRemoveCart = $this->getPost('remove_cart');
         if (!empty($idRemoveCart)) {
            unset($_SESSION['user'][$userIP]['cart'][$idRemoveCart]);
         }
         $productIDs = [];
         $productCounts = [];
         foreach ($_SESSION['user'][$userIP]['cart'] as $idProduct => $count) {
            $productIDs[$idProduct] = $idProduct;
            $productCounts[$idProduct] = $count;
         }
         
         $filters = [
            'ids_product' => [],
         ];
         if (!empty($productIDs)) {
            $filters['ids_product'] = $productIDs;
         }
         $viewFile = '';
         if (!empty($filters['ids_product'])) {
            $allProducts = $productModel->getAllProducts($filters);
            $prices = [];
            $totalPrices = [];
            foreach ($allProducts as $idProduct => $oneProduct) {
               foreach ($oneProduct['prices'] as $idPrice => $onePrice) {
                  foreach ($onePrice as $priceStatus => $price) {
                     if ($priceStatus === 'retail') {
                        $prices[$idProduct] = $allProducts[$idProduct]['prices'][$idPrice]['retail'];
                        $totalPrices[$idProduct] = $allProducts[$idProduct]['prices'][$idPrice]['retail'] * $productCounts[$idProduct]['count'];
                     // } elseif ($priceStatus === 'discount') {
                     //    $price = $allProducts[$idProduct]['prices'][$idPrice]['discount'];
                     //    $totalPrices[$idProduct] = $allProducts[$idProduct]['prices'][$idPrice]['discount'] * $productCounts[$idProduct]['count'];
                     }
                  }
               }
            }
            $content = [
               'allProducts' => $allProducts,
               'productCounts' => $productCounts,
               'prices' => $prices,
               'totalPrices' => $totalPrices,
            ];

            $viewFile = $this->view('home/cart', $content);
         } else {
            $viewFile = $this->view('templates/noCart');
         }

         return $viewFile;
      }
   }
?>