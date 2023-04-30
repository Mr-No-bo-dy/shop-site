<?php 
   use app\vendor\Controller;
   use app\helpers\Request;
   use app\models\Status;
   use app\models\User;

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
         $statusModel = new Status();
         $request = new Request();
         
         $errors = $request->checkPost($this->getPost());
         if (empty($errors)) {
            $statusModel->insert($this->getPost());
         }
         
         return $this->redirect('../status');
      }
   }

?>