<?php 
   use app\vendor\Controller;
   use app\helpers\Request;
   use app\models\Product;

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

      
      // Control which method would be used
      public function actionChange()
      {
         $post = $this->getPost();
         if (isset($post['create'])) {
            $this->actionCreate($post);
         } elseif (isset($post['update'])) {
            $this->actionUpdate($post);
         } elseif (isset($post['delete'])) {
            $this->actionDelete($post['delete']);
         }
      }

      // Create new Category
      public function actionCreate(array $data)
      {
         $request = new Request();
         
         $productModel = new Product();
         $setProductData = [
            'id_status' => $data['id_status'],
            'main_image' => $data['main_image'],
            'name' => $data['name'],
            'description' => $data['description'],
            'quantity' => $data['quantity'],
         ];
         echo '<pre>';
         var_dump($setProductData);
         die;
         $errors = $request->checkPost($setProductData);
         if (empty($errors)) {
            $productModel->insert($setProductData);
         }
         
         return $this->redirect('../product');
      }

      // Update existing Category
      public function actionUpdate(array $data = [])
      {
         $productModel = new Product();
         $request = new Request();
         
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

      // Delete some Category
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