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
      
      // Create new Category
      public function actionCreate()
      {
         $request = new Request();
         
         $errors = $request->checkPost($this->getPost());
         if (empty($errors)) {
            $statusModel = new Status();
            $statusModel->insert($this->getPost());
         }
         
         return $this->redirect('../status');
      }

      public function actionChange()
      {
         if (isset($_POST['update'])) {
            $this->actionUpdate();
         } elseif (isset($_POST['delete'])) {
            $this->actionDelete();
         }
      }

      // Update existing Category
      public function actionUpdate()
      {
         $statusModel = new Status();
         $request = new Request();
         
         $errors = $request->checkPost($this->getPost());
         if (empty($errors)) {
            $data = [
               'id_status' => $this->getPost('id_status'),
               'name' => $this->getPost('name'),
               'category' => $this->getPost('category'),
            ];
   
            $statusModel->update($this->getPost('id_status'), $data);
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