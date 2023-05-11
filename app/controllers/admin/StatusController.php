<?php 
   use app\vendor\Controller;
   use app\helpers\Request;
   use app\models\Status;

   class StatusController extends Controller
   {
      public function actionIndex()
      {
         $statusModel = new Status();

         $allStatuses = $statusModel->getAll();
         $content = [
            'allStatuses' => $allStatuses,
         ];

         return $this->view('admin/status/index', $content);
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
         
         $statusModel = new Status();
         $setStatusData = [
            'name' => $data['name'],
            'category' => $data['category'],
         ];
         $errors = $request->checkPost($setStatusData);
         if (empty($errors)) {
            $statusModel->insert($setStatusData);
         }
         
         return $this->redirect('../status');
      }

      // Update existing Category
      public function actionUpdate(array $data = [])
      {
         $statusModel = new Status();
         $request = new Request();
         
         $setStatusData = [
            'name' => $data['name'],
            'category' => $data['category'],
         ];
         
         $errors = $request->checkPost($setStatusData);
         if (empty($errors)) {
            $statusModel->update($data['id_status'], $setStatusData);
         }
 
         return $this->redirect('../status');
      }

      // Delete some Category
      public function actionDelete()
      {
         if ($this->getPost('delete')) {
            $statusModel = new Status();
            $idStatus = $this->getPost('delete');
            $statusModel->delete($idStatus);
         }

         return $this->redirect('../status');
      }
   }

?>