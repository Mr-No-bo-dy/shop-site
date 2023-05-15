<?php 
   use app\vendor\Controller;
   use app\helpers\Request;
   use app\models\Product;
   use app\models\Price;
   use app\models\Status;

   class ProductController extends Controller
   {
      public function actionIndex()
      {
         $productModel = new Product();

         $allProducts = $productModel->getAllProducts();
         $content = [
            'products' => $allProducts,
         ];
            
         return $this->view('admin/product/index', $content);
      }

      public function actionOpen()
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
      
      // // Control which method would be used
      // public function actionChange()
      // {
      //    $post = $this->getPost();
      //    if (isset($post['create'])) {
      //       $this->actionCreate($post);
      //    } elseif (isset($post['update'])) {
      //       $this->actionUpdate($post);
      //    } elseif (isset($post['delete'])) {
      //       $this->actionDelete($post['delete']);
      //    }
      // }

      // Create new Product
      public function actionCreate()
      {
         $productModel = new Product();
         $request = new Request();
         $statusModel = new Status();

         $allStatuses = $statusModel->getAll();
         $priceStatuses = $productStatuses = [];
         foreach ($allStatuses as $status) {
            switch ($status['category']) {
               case 'price':
                  $priceStatuses[] = $status;
                  break;
               case 'product':
                  $productStatuses[] = $status;               
                  break;
            }
         }

         if (!is_null($this->getPost('create'))) {
            $postData = $this->getPost();
            $imageName = $request->saveMedia();
            // echo '<pre>';
            // var_dump($imageName);
            // die;

            $setProductData = [
               'name' => $postData['name'],
               'description' => $postData['description'],
               'id_status' => $postData['productStatus'],
               'quantity' => $postData['quantity'],
               'main_image' => $imageName,
            ];
            
            // $errors = $request->checkPost($setProductData);
            // if (empty($errors)) {
               $productModel->insert($setProductData);
            // }
         }

         $content = [
            'priceStatuses' => $priceStatuses,
            'productStatuses' => $productStatuses,
         ];
         
         return $this->view('admin/product/create', $content);
      }

      // Update existing Product
      public function actionUpdate(array $data = [])
      {
         $request = new Request();
         $productModel = new Product();
         
         $setProductData = [
            'name' => $data['name'],
            'description' => $data['description'],
            'quantity' => $data['quantity'],
         ];
         
         $errors = $request->checkPost($setProductData);
         if (empty($errors)) {
            $productModel->update($data['id_product'], $setProductData);
         }
 
         return $this->redirect('../product');
      }

      // Delete some Product
      public function actionDelete()
      {
         if ($this->getPost('delete')) {
            $productModel = new Product();

            $idProduct = $this->getPost('delete');
            $productModel->delete($idProduct);
         }

         return $this->redirect('../product');
      }
   }