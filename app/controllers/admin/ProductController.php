<?php 
   use app\vendor\Controller;
   use app\helpers\Request;
   use app\models\Product;
   use app\models\Price;
   use app\models\Status;
   use app\models\ProductCategory;
   use app\models\Order;

   class ProductController extends Controller
   {
      // Show all Products
      public function actionIndex()
      {
         $productModel = new Product();

         $allProducts = $productModel->getAllProducts();
         $content = [
            'products' => $allProducts,
         ];
            
         return $this->view('admin/product/index', $content);
      }

      // Show one Product
      public function actionShow()
      {
         $productModel = new Product();
         $priceModel = new Price();
         $statusModel = new Status();

         $id = $this->getGet('id');
         $product = $productModel->getOne($id);
         $productPrices = $priceModel->getAll(['id_product' => [$id]]);
         $idsPriceStatus = array_column($productPrices, 'id_status');
         $priceStatuses = [];
         if (!empty($idsPriceStatus)) {
            $priceStatuses = $statusModel->getAll(['id_status' => $idsPriceStatus]);
         }
         $content = [
            'product' => $product,
            'prices' => $productPrices,
            'statuses' => $priceStatuses,
         ];
         
         return $this->view('admin/product/view', $content);
      }

      // Create new Product
      public function actionCreate()
      {
         $request = new Request();
         $productModel = new Product();
         $statusModel = new Status();
         $priceModel = new Price();

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
            }
         }
         
         return $this->view('admin/product/create', $content);
      }

      // Update existing Product
      public function actionUpdate()
      {
         $request = new Request();
         $productModel = new Product();
         $priceModel = new Price();
         $statusModel = new Status();
         
         // Отримання з БД всіх даних одного продукту
         $id = $this->getGet('id');
         $product = $productModel->getOne($id);
         $productPrices = $priceModel->getAll(['id_product' => [$id]]);
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
            'allPriceStatuses' => $allPriceStatuses,
            'allProductStatuses' => $allProductStatuses,
         ];

         // Підготовка і виконання Апдейту даних
         if (!is_null($this->getPost('update'))) {
            $postData = $this->getPost();
            $idProduct = $postData['update'];

            $fileData = $this->getFiles('main_image');
            if (!empty($fileData['name'])) {
               // Видалення старого зображення
               $productImage = $product['main_image'];
               $imgLocation = 'app/resource/uploads/' . $productImage;
               // Видалення старого зображення, лише якщо до цього ніякого не було
               $imgLocArray = explode('/', $imgLocation);
               if (!empty(end($imgLocArray))) {
                  unlink($imgLocation);
               }
               // Збереження нового зображення
               $imageName = $request->saveMedia();
            } else {
               // Залишаєтсья старе зображення
               $imageName = $product['main_image'];
            }

            $setProductData = [
               'name' => $postData['name'],
               'description' => $postData['description'],
               'id_status' => $postData['productStatus'],
               'quantity' => $postData['quantity'],
               'main_image' => $imageName,
            ];

            // Перевірка перед Апдейтом: чи змілось хоч одне поле
            $isSmthChanged = false;
            foreach ($setProductData as $key => $setProductItem) {
               if ($setProductItem != $product[$key]) {
                  $isSmthChanged = true;
               }
            }
            foreach ($productPrices as $idPrice => $productPrice) {
               if (($productPrice['price'] != $postData['price'][$idPrice]) || ($productPrices[$idPrice]['id_status'] != $postData['priceStatus'][$idPrice])) {
                  $isSmthChanged = true;
               }
            }

            // В БД все одно коли апдейтиш БЕЗ зміни даних дата оновлення НЕ змінюється, то чи треба ця перевірка?
            if ($isSmthChanged) {
               $productModel->update($idProduct, $setProductData);
   
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
               // Додавання нової ціни
               if (!empty($postData['newPrice']) && !empty($postData['newPriceStatus'])) {
                  $insertPriceData = [
                     'id_product' => $idProduct,
                     'id_status' => $postData['newPrice'],
                     'price' => $postData['newPriceStatus'],
                  ];
                  $priceModel->insert($insertPriceData);
               }
            }
         }

         // Отримання з БД всіх даних одного продукту
         $id = $this->getGet('id');
         $product = $productModel->getOne($id);
         $productPrices = $priceModel->getAll(['id_product' => [$id]]);
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
            'allPriceStatuses' => $allPriceStatuses,
            'allProductStatuses' => $allProductStatuses,
         ];
         
         return $this->view('admin/product/update', $content);
      }

      // Delete some Product with it's prices
      public function actionDelete()
      {
         if ($this->getPost('delete')) {
            $productModel = new Product();
            $productCategoryModel = new ProductCategory();
            $priceModel = new Price();
            $orderModel = new Order();

            $idProduct = $this->getPost('delete');
            $product = $productModel->getOne($idProduct);
            $productCategories = $productCategoryModel->getAll(['id_product' => [$idProduct]]);
            $productPrices = $priceModel->getAll(['id_product' => [$idProduct]]);
            $productOrders = $orderModel->getAll(['id_product' => [$idProduct]]);
            $productImage = $product['main_image'];
            $imgLocation = 'app/resource/uploads/' . $productImage;

            $imgLocArray = explode('/', $imgLocation);
            if (!empty(end($imgLocArray))) {
               unlink($imgLocation);
            }
            if (!empty($productCategories)) {
               $productCategoryModel->delete(array_column($productCategories, 'id_product'), 'id_product');

            }
            if (!empty($productPrices)) {
               $priceModel->delete(array_column($productPrices, 'id_product'), 'id_product');

            }
            if (!empty($productOrders)) {
               $orderModel->delete(array_column($productOrders, 'id_product'), 'id_product');
            }
            $productModel->delete($idProduct);
         }

         return $this->redirect('../products');
      }
   }