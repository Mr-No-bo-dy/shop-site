<?php 
   use app\vendor\Controller;
   use app\helpers\Request;
   use app\models\Category;
   use app\models\SubCategory;
   use app\models\ProductCategory;

   class CategoryController extends Controller
   {
      // Control which method would be used
      public function actionCheck()
      {
         $post = $this->getPost();
         if (isset($post['create'])) {
            $this->actionCreate($post);
         } elseif (isset($post['update'])) {
            $this->actionUpdate($post);
         } elseif (isset($post['delete'])) {
            $this->actionDelete($post['delete']);
         } else {
            $this->actionIndex();
         }
      }

      // Show all Categories
      public function actionIndex(array $data = [])
      {
         $categoryModel = new Category();

         $allCategories = $categoryModel->getAll();
         $content = [
            'allCategories' => $allCategories,
            'errors' => $data,
         ];

         return $this->view('admin/category/index', $content);
      }

      // Create new Category
      public function actionCreate(array $data)
      {
         $request = new Request();
         $categoryModel = new Category();

         $setCategoryData = [
            'name' => $data['name'],
            'description' => $data['description'],
         ];
         $errors = $request->checkPost($setCategoryData);
         if (empty($errors)) {
            $categoryModel->insert($setCategoryData);
         }
         $setCategoryData['errors'] = $errors;
         
         return $this->actionIndex($setCategoryData['errors']);
      }

      // Update existing Category
      public function actionUpdate(array $data = [])
      {
         $request = new Request();
         $categoryModel = new Category();
         
         $setCategoryData = [
            'name' => $data['name'],
            'description' => $data['description'],
         ];
         
         $errors = $request->checkPost($setCategoryData);
         if (empty($errors)) {
            $categoryModel->update($data['id_category'], $setCategoryData);
         }
 
         return $this->actionIndex();
      }

      // Delete some category
      public function actionDelete()
      {
         if ($this->getPost('delete')) {
            $categoryModel = new Category();
            $subCategoryModel = new SubCategory();
            $productCategoryModel = new ProductCategory();

            $idCategory = $this->getPost('delete');
            $productCategories = $productCategoryModel->getAll(['id_category' => [$idCategory]]);
            $subCategory = $subCategoryModel->getAll(['id_category' => [$idCategory]]);

            if (!empty($productCategories)) {
               $productCategoryModel->delete(array_column($productCategories, 'id_category'), 'id_category');
            }
            if (!empty($subCategory)) {
               $subCategoryModel->delete(array_column($subCategory, 'id_category'), 'id_category');
            }
            $categoryModel->delete($idCategory);
         }

         return $this->redirect('category');
      }
   }

?>