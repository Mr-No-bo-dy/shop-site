<?php 
   use app\vendor\Controller;
   use app\helpers\Request;
   use app\models\Product;
   use app\models\Price;
   use app\models\Status;

   class ProductController extends Controller
   {
      // Show all Products
      public function actionIndex()
      {
         $productModel = new Product();

         $allProducts = $productModel->getAllProducts();
         
         // $products = [];
         // foreach ($allProducts as $key => $product) {
         //    // $products[$key]['name'] = $product['name'];
         //    $products[$key] = $product;
         //    $products[$key]['main_image'] = $this->getImage([
         //       'name' => $product['main_image'],
         //       'alt' => $product['name'] . '_image',
         //       'class' => 'image',
         //       'id' => 'img' . [$key],
         //    ]);
         // }
         // echo '<pre>';
         // var_dump($products);
         // die;
         $content = [
            'products' => $allProducts,
            // 'products' => $products,
         ];
            
         return $this->view('admin/product/index', $content);
      }

      // Show one Product
      public function actionShow()
      {
         $id = $this->getGet('id');
         $productModel = new Product();
         $priceModel = new Price();
         $statusModel = new Status();

         $product = $productModel->getOne($id);
         $productPrices = $priceModel->getAll(['id_product' => [$id]]);
         $idsPriceStatus = array_column($productPrices, 'id_status');
         $priceStatuses = $statusModel->getAll(['id_status' => $idsPriceStatus]);
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
            
            // $errors = $request->checkPost($setProductData);
            // if (empty($errors)) {
               $idProduct = $productModel->insert($setProductData);
               if (!empty($idProduct)) {
                  $setPriceData = [
                     'id_product' => $idProduct,
                     'id_status' => $postData['priceStatus'],
                     'price' => $postData['price'],
                  ];
                  $priceModel->insert($setPriceData);
               }
            // }
         }
         
         return $this->view('admin/product/create', $content);
      }

      // Update existing Product
      public function actionUpdate()
      {
         $id = $this->getGet('id');
         $request = new Request();
         $productModel = new Product();
         $priceModel = new Price();
         $statusModel = new Status();

         // Отримання з БД всіх даних одного продукту
         $product = $productModel->getOne($id);
         $productPrices = $priceModel->getAll(['id_product' => [$id]]);
         $idsPriceStatus = array_column($productPrices, 'id_status');
         $priceStatuses = $statusModel->getAll(['id_status' => $idsPriceStatus]);

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
            $imageName = $request->saveMedia();
            $setProductData = [
               'name' => $postData['name'],
               'description' => $postData['description'],
               'id_status' => $postData['productStatus'],
               'quantity' => $postData['quantity'],
               'main_image' => $imageName,
            ];
            $productModel->update($id, $setProductData);

            $setPriceData = [];
            foreach ($productPrices as $idPrice => $price) {
               $setPriceData = [
                  'id_product' => $id,
                  'id_status' => $postData['priceStatus'][$idPrice],
                  'price' => $postData['price'][$idPrice],
               ];
               $priceModel->update($productPrices[$idPrice]['id_price'], $setPriceData);
            }
         }
         
         return $this->view('admin/product/update', $content);
      }

      // Delete some Product with it's prices
      public function actionDelete()
      {
         if ($this->getPost('delete')) {
            $idProduct = $this->getPost('delete');

            $productModel = new Product();
            $priceModel = new Price();

            $productPrices = $priceModel->getAll(['id_product' => [$idProduct]]);
            foreach ($productPrices as $price) {
               $id_price = $price['id_price'];
               $priceModel->delete($id_price);
            }
            $productModel->delete($idProduct);
         }

         return $this->actionIndex();
         // return $this->redirect('../products');
      }
   }