<?php 
   use app\vendor\Controller;
   use app\helpers\Request;
   use app\models\Status;

   class StatusController extends Controller
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

      // Show all Statuses
      public function actionIndex(array $data = [])
      {
         $statusModel = new Status();

         $allStatuses = $statusModel->getAll();
         $content = [
            'allStatuses' => $allStatuses,
            'errors' => $data,
         ];

         return $this->view('admin/status/index', $content);
      }

      // Create new Status
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
         $setStatusData['errors'] = $errors;
         
         // return $this->redirect('../status');
         return $this->actionIndex($setStatusData['errors']);
      }

      // Update existing Status
      public function actionUpdate(array $data = [])
      {
         $request = new Request();
         $statusModel = new Status();
         
         $setStatusData = [
            'name' => $data['name'],
            'category' => $data['category'],
         ];
         
         $errors = $request->checkPost($setStatusData);
         if (empty($errors)) {
            $statusModel->update($data['id_status'], $setStatusData);
         }
 
         // return $this->redirect('../status');
         return $this->actionIndex();
      }

      // Delete some Status
      public function actionDelete()
      {
         if ($this->getPost('delete')) {
            $statusModel = new Status();
            
            $idStatus = $this->getPost('delete');
            $statusModel->delete($idStatus);
         }

         return $this->redirect('status');
      }
   }

?>