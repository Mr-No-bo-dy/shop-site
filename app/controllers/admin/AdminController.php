<?php 
   require_once 'app/vendor/Controller.php';

   class AdminController extends Controller
   {
      public function actionIndex()
      {
         $this->render('admin/dashboard/index', 
            [

            ]
         );
      }
   }

?>