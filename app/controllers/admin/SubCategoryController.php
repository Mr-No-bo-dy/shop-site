<?php 
   use app\vendor\Controller;
   use app\helpers\Request;
   use app\models\Category;
   use app\models\SubCategory;

   class SubCategoryController extends Controller
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

      // Show all SubCategories
      public function actionIndex(array $errors = [])
      {
         $subCategoryModel = new SubCategory();
         $categoryModel = new Category();

         $allSubCategories = $subCategoryModel->getAll();
         $allCategories = $categoryModel->getAll();
         $setSubCategories = [];
         foreach ($allSubCategories as $idSubCat => $subCategory) {
            $setSubCategories[$idSubCat] = $subCategory;
            foreach ($allCategories as $category) {
               if ($subCategory['id_category'] === $category['id_category']) {
                  $setSubCategories[$idSubCat]['category_name'] = $category['name'];
               }
            }
         }
         $content = [
            'setSubCategories' => $setSubCategories,
            'allCategories' => $allCategories,
            'errors' => $errors,
         ];

         return $this->view('admin/subcategory/index', $content);
      }

      // Create new SubCategory
      public function actionCreate(array $data)
      {
         $request = new Request();
         $subCategoryModel = new SubCategory();

         $setSubCategoryData = [
            'id_category' => $data['id_category'],
            'name' => $data['name'],
            'description' => $data['description'],
         ];
         $errors = $request->checkPost($setSubCategoryData);
         if (empty($errors)) {
            $subCategoryModel->insert($setSubCategoryData);
         }
         $setSubCategoryData['errors'] = $errors;
         
         return $this->actionIndex($setSubCategoryData['errors']);
      }

      // Update existing SubCategory
      public function actionUpdate(array $data = [])
      {
         $request = new Request();
         $subCategoryModel = new SubCategory();
         
         $setSubCategoryData = [
            'id_category' => $data['id_category'],
            'name' => $data['name'],
            'description' => $data['description'],
         ];
         
         $errors = $request->checkPost($setSubCategoryData);
         if (empty($errors)) {
            $subCategoryModel->update($data['id_sub_category'], $setSubCategoryData);
         }
 
         return $this->actionIndex();
      }

      // Delete some SubCategory
      public function actionDelete()
      {
         if ($this->getPost('delete')) {
            $subCategoryModel = new SubCategory();
            
            $idSubCategory = $this->getPost('delete');
            $subCategoryModel->delete($idSubCategory);
         }

         return $this->redirect('subcategory');
      }
   }

?>