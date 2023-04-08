<?php 
   require_once 'app/vendor/Controller.php';

   class HomeController extends Controller
   {
      public function actionIndex()
      {
         $name = 'Olex';
         $this->render('home/index', ['name' => $name]);
      }
   }