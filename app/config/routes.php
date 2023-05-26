<?php 
   $urlRoutes = [
      // request (in URL) => ( dir / ) controller / method

      // 'admin/admin' => 'admin/admin/index',
      // 'admin/dashboard' => 'admin/admin/index',
      'admin' => 'admin/admin/index',

      'admin/register' => 'admin/admin/register',
      'admin/login' => 'admin/admin/login',
      'admin/logout' => 'home/logout',
      'logout' => 'home/logout',
      
      'admin/status' => 'admin/status/check',
      'admin/category' => 'admin/category/check',
      'admin/subcategory' => 'admin/subcategory/check',

      'admin/products' => 'admin/product/index',
      'admin/product' => 'admin/product/show',
      'admin/product/create' => 'admin/product/create',
      'admin/product/update' => 'admin/product/update',
      'admin/product/delete' => 'admin/product/delete',

      '' => 'home/index',
      'home' => 'home/index',

      // 'register' => 'home/register',
      // 'login' => 'home/login',

   ];
?>