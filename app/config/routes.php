<?php 
   $urlRoutes = [
      // request (in URL) => ( dir / ) controller / method

      // 'admin/admin' => 'admin/admin/index',
      // 'admin/dashboard' => 'admin/admin/index',
      'admin' => 'admin/admin/index',

      'admin/register' => 'admin/admin/register',
      'admin/login' => 'admin/admin/login',
      
      // 'admin/status' => 'admin/status/index',
      // 'admin/status/check' => 'admin/status/check',
      'admin/status' => 'admin/status/check',

      'admin/products' => 'admin/product/index',
      'admin/product' => 'admin/product/show',
      'admin/product/create' => 'admin/product/create',
      'admin/product/update' => 'admin/product/update',
      'admin/product/delete' => 'admin/product/delete',

      'admin/logout' => 'home/logout',
      'logout' => 'home/logout',

      '' => 'home/index',
      'home' => 'home/index',

      // 'register' => 'home/register',
      // 'login' => 'home/login',

   ];
?>