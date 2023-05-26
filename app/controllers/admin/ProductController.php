<?php 
   use app\vendor\Controller;
   use app\helpers\Request;
   use app\models\Product;
   use app\models\Category;
   use app\models\Price;
   use app\models\Status;
   use app\models\Order;

   class ProductController extends Controller
   {
      // Show all Products
      public function actionIndex()
      {
         $productModel = new Product();
         $categoryModel = new Category();

         $filters = [
            'id_category' => 0,
         ];
         $idCategory = $this->getPost('id_category');
         if (!empty($idCategory)) {
            $filters['id_category'] = $idCategory;
         }
         $resetFilters = $this->getPost('resetFilters');
         if (!empty($resetFilters)) {
            unset($_SESSION['filters']);
         }
         if (!empty($filters['id_category'])) {
            $_SESSION['filters'] = $filters;
         }
         if (!empty($_SESSION['filters'])) {
            $filters = $_SESSION['filters'];
         }
         
         $allProducts = $productModel->getAllProducts($filters);
         $allCategories = $categoryModel->getAll();

         $content = [
            'products' => $allProducts,
            'allCategories' => $allCategories,
            'filters' => $filters,
         ];
            
         return $this->view('admin/product/index', $content);
      }

      // Show one Product
      public function actionShow()
      {
         $productModel = new Product();
         $categoryModel = new Category();
         $priceModel = new Price();
         $statusModel = new Status();

         $idProduct = $this->getGet('id');
         $product = $productModel->getOne($idProduct);
         $productCategory = $productModel->getOne($idProduct, ['table' => 'products_categories']);
         if (!empty($productCategory['id_category'])) {
            $category = $categoryModel->getOne($productCategory['id_category']);
         }
         $productStatus = $statusModel->getOne($product['id_status']);
         $productPrices = $priceModel->getAll(['id_product' => [$idProduct]]);
         $idsPriceStatus = array_column($productPrices, 'id_status');
         $priceStatuses = [];
         if (!empty($idsPriceStatus)) {
            $priceStatuses = $statusModel->getAll(['id_status' => $idsPriceStatus]);
         }
         $content = [
            'product' => $product,
            'prices' => $productPrices,
            'statuses' => $priceStatuses,
            'status' => $productStatus['name'],
            'category' => $category['name'] ?? '',
         ];
         
         return $this->view('admin/product/view', $content);
      }

      // Create new Product
      public function actionCreate()
      {
         $request = new Request();
         $productModel = new Product();
         $categoryModel = new Category();
         $statusModel = new Status();
         $priceModel = new Price();

         $allCategories = $categoryModel->getAll();
         $allStatuses = $statusModel->getAll();
         $allPriceStatuses = $allProductStatuses = [];
         foreach ($allStatuses as $status) {
            switch ($status['category']) {
               case 'price':
                  $allPriceStatuses[] = $status;
                  break;
               case 'product':
                  $allProductStatuses[] = $status;               
                  break;
            }
         }
         $content = [
            'allCategories' => $allCategories,
            'allPriceStatuses' => $allPriceStatuses,
            'allProductStatuses' => $allProductStatuses,
         ];

         if (!is_null($this->getPost('create'))) {
            $postData = $this->getPost();
            $imageName = $request->saveMedia();
            $setProductData = [
               'name' => $postData['name'],
               'description' => $postData['description'],
               'id_status' => $postData['productStatus'],
               'quantity' => $postData['quantity'],
               'main_image' => $imageName,
            ];
            
            $idProduct = $productModel->insert($setProductData);
            if (!empty($idProduct)) {
               $setPriceData = [
                  'id_product' => $idProduct,
                  'id_status' => $postData['priceStatus'],
                  'price' => $postData['price'],
               ];
               $priceModel->insert($setPriceData);

               $setProductCategoryData = [
                  'id_product' => $idProduct,
                  'id_category' => $postData['id_category'],
               ];
               $productModel->insert($setProductCategoryData, ['table' => 'products_categories']);
            }
         }
         
         return $this->view('admin/product/create', $content);
      }

      // Update existing Product
      public function actionUpdate()
      {
         $request = new Request();
         $productModel = new Product();
         $categoryModel = new Category();
         $priceModel = new Price();
         $statusModel = new Status();
         
         // Отримання з БД всіх даних одного продукту
         $idProduct = $this->getGet('id');
         $product = $productModel->getOne($idProduct);
         $allCategories = $categoryModel->getAll();
         $productCategory = $productModel->getOne($idProduct, ['table' => 'products_categories']);
         $productPrices = $priceModel->getAll(['id_product' => [$idProduct]]);
         $idsPriceStatus = array_column($productPrices, 'id_status');
         $priceStatuses = [];
         if (!empty($idsPriceStatus)) {
            $priceStatuses = $statusModel->getAll(['id_status' => $idsPriceStatus]);
         }
            // Отримання з БД і розділення всіх статусів на статуси_продуктів і _цін для виведення в різних select'ах
         $allStatuses = $statusModel->getAll();
         $allPriceStatuses = $allProductStatuses = [];
         foreach ($allStatuses as $status) {
            switch ($status['category']) {
               case 'price':
                  $allPriceStatuses[] = $status;
                  break;
               case 'product':
                  $allProductStatuses[] = $status;
                  break;
            }
         }

         // Delete price
         if (!is_null($this->getPost('deletePrice'))) {
            $postData = $this->getPost();
            if (isset($postData['deletePrice'])) {
               $priceModel->delete($postData['deletePrice']);
            }
         }
         // Prepare & execute data Update
         if (!is_null($this->getPost('update'))) {
            $postData = $this->getPost();
            $idProduct = $postData['update'];

            // Image update
            $fieldata = $this->getFiles('main_image');
            if (!empty($fieldata['name'])) {
               // Delete old image
               $productImage = $product['main_image'];
               $imgLocation = 'app/resource/uploads/' . $productImage;
                  // Delete old image only if there was not one before
               $imgLocArray = explode('/', $imgLocation);
               if (!empty(end($imgLocArray))) {
                  unlink($imgLocation);
               }
               // Save new image
               $imageName = $request->saveMedia();
            } else {
               // Keep old image
               $imageName = $product['main_image'];
            }

            $setProductData = [
               'name' => $postData['name'],
               'description' => $postData['description'],
               'id_status' => $postData['productStatus'],
               'quantity' => $postData['quantity'],
               'main_image' => $imageName,
            ];
            $setCategoryData = [
               'id_category' => $postData['id_category'],
            ];

            // Add new price
            if (!empty($postData['newPriceStatus']) && !empty($postData['newPrice'])) {
               $insertPriceData = [
                  'id_product' => $idProduct,
                  'id_status' => $postData['newPriceStatus'],
                  'price' => $postData['newPrice'],
               ];
               $priceModel->insert($insertPriceData);
            }

            // Перевірка перед Апдейтом: чи змілось хоч одне поле
            $isSmthChanged = false;
            foreach ($setProductData as $key => $setProductItem) {
               if ($setProductItem != $product[$key]) {
                  $isSmthChanged = true;
               }
            }
            foreach ($allCategories as $category) {
               if ($category['id_category'] != $postData['id_category']) {
                  $isSmthChanged = true;
               }
            }
            foreach ($productPrices as $idPrice => $productPrice) {
               if (($productPrice['price'] != $postData['price'][$idPrice]) || ($productPrices[$idPrice]['id_status'] != $postData['priceStatus'][$idPrice])) {
                  $isSmthChanged = true;
               }
            }
            if ($isSmthChanged) {
               $productModel->update($idProduct, $setProductData);
               $productModel->update($productCategory['id_product_category'], $setCategoryData, ['field' => 'id_product_category', 'table' => 'products_categories']);

               $setPriceData = [];
               foreach ($postData['price'] as $idPrice => $price) {
                  $setPriceData = [
                     'price' => $price,
                  ];
                  $priceModel->update($idPrice, $setPriceData);
               }
               foreach ($postData['priceStatus'] as $idPrice => $id_status) {
                  $setPriceData = [
                     'id_status' => $id_status,
                  ];
                  $priceModel->update($idPrice, $setPriceData);
               }
            }
         }

         // Отримання з БД всіх даних одного продукту
         $idProduct = $this->getGet('id');
         $product = $productModel->getOne($idProduct);
         $allCategories = $categoryModel->getAll();
         $productCategory = $productModel->getOne($idProduct, ['table' => 'products_categories']);
         $productPrices = $priceModel->getAll(['id_product' => [$idProduct]]);
         $idsPriceStatus = array_column($productPrices, 'id_status');
         $priceStatuses = [];
         if (!empty($idsPriceStatus)) {
            $priceStatuses = $statusModel->getAll(['id_status' => $idsPriceStatus]);
         }
            // Отримання з БД і розділення всіх статусів на статуси_продуктів і _цін для виведення в різних select'ах
         $allStatuses = $statusModel->getAll();
         $allPriceStatuses = $allProductStatuses = [];
         foreach ($allStatuses as $status) {
            switch ($status['category']) {
               case 'price':
                  $allPriceStatuses[] = $status;
                  break;
               case 'product':
                  $allProductStatuses[] = $status;
                  break;
            }
         }
 
         // Формування даних на В'юшку
         $content = [
            'product' => $product,
            'prices' => $productPrices,
            'statuses' => $priceStatuses,
            'idCategory' => $productCategory['id_category'],
            'allCategories' => $allCategories,
            'allProductStatuses' => $allProductStatuses,
            'allPriceStatuses' => $allPriceStatuses,
         ];
         
         return $this->view('admin/product/update', $content);
      }

      // Delete some Product
      public function actionDelete()
      {
         if ($this->getPost('delete')) {
            $productModel = new Product();
            $priceModel = new Price();
            $orderModel = new Order();

            $idProduct = $this->getPost('delete');
            $product = $productModel->getOne($idProduct);
            $productCategories = $productModel->getAll(['id_product' => [$idProduct]], ['table' => 'products_categories']);
            $productPrices = $priceModel->getAll(['id_product' => [$idProduct]]);
            $productOrders = $orderModel->getAll(['id_product' => [$idProduct]]);
            $productImage = $product['main_image'];
            $imgLocation = 'app/resource/uploads/' . $productImage;
            $imgLocArray = explode('/', $imgLocation);
            
            if (!empty(end($imgLocArray))) {
               unlink($imgLocation);
            }
            if (!empty($productCategories)) {
               $productModel->delete(array_column($productCategories, 'id_product'), ['table' => 'products_categories']);
            }
            if (!empty($productPrices)) {
               $priceModel->delete(array_column($productPrices, 'id_product'), ['field' => 'id_product']);
            }
            if (!empty($productOrders)) {
               $orderModel->delete(array_column($productOrders, 'id_product'), ['field' => 'id_product']);
            }
            $productModel->delete($idProduct);
         }

         return $this->redirect('../products');
      }
   }