<?php 
   use app\vendor\Controller;
   use app\helpers\Request;
   use app\models\Product;
   use app\models\Category;
   use app\models\SubCategory;
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
         $allCategories = $categoryModel->getAll();
         $allSubCategories = $subCategoryModel->getAll();
         $allStatuses = $statusModel->getAll(['category' => ['product']]);
         $allProducts = $productModel->getAllProducts($filters);
         $content = [
            'products' => $allProducts,
            'allSubCategories' => array_merge([0 => ['id_sub_category' => 0, 'name' => 'All SubCategories']], $allSubCategories),
            'allCategories' => array_merge([0 => ['id_category' => 0, 'name' => 'All Categories']], $allCategories),
            'allStatuses' => array_merge([0 => ['id_status' => 0, 'name' => 'All Statuses']], $allStatuses),
            'filters' => $filters,
         ];
            
         return $this->view('admin/product/index', $content);
      }

      // Show one Product
      public function actionView()
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

      // Get Data from DB for product's Update
      public function actionUpdateData()
      {
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

         $updateData = [
            'product' => $product,
            'allCategories' => $allCategories,
            'productCategory' => $productCategory,
            'productPrices' => $productPrices,
            'priceStatuses' => $priceStatuses,
            'allPriceStatuses' => $allPriceStatuses,
            'allProductStatuses' => $allProductStatuses,
         ];
         return $updateData;
      }

      // Update existing Product
      public function actionUpdate()
      {
         $request = new Request();
         $productModel = new Product();
         $priceModel = new Price();

         // Отримання з БД всіх даних одного продукту
         $updateData = $this->actionUpdateData();
         extract($updateData, EXTR_OVERWRITE);

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
               if (($productPrice['price'] != $postData['price'][$idPrice]) || ($productPrices[$idPrice]['id_status'] != $postData['priceStatus'][$idPrice]) || !empty($postData['active'])) {
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
                     'active' => 0,
                  ];
                  $priceModel->update($idPrice, $setPriceData);
               }
               $idPriceActive = $this->getPost('active');
               if ((!empty($idPriceActive))) {
                  $setPriceData = [
                     'active' => 1,
                  ];
                  $priceModel->update($idPriceActive, $setPriceData);
               }
            }
         }

         // Отримання з БД всіх даних одного продукту
         $updateData = $this->actionUpdateData();
         extract($updateData, EXTR_OVERWRITE);
 
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