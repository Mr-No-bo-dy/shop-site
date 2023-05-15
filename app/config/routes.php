<?php 
   $urlRoutes = [
      // request (in URL) => ( dir / ) controller / method

      'admin' => 'admin/admin/index',
      // 'admin/admin' => 'admin/admin/index',
      // 'admin/dashboard' => 'admin/admin/index',

      'admin/register' => 'admin/admin/register',
      'admin/login' => 'admin/admin/login',
      
      'admin/status' => 'admin/status/index',
      'admin/status/change' => 'admin/status/change',

      'admin/products' => 'admin/product/index',
      'admin/product' => 'admin/product/open',
      // 'admin/product/change' => 'admin/product/change',
      'admin/product/create' => 'admin/product/create',
      // 'admin/product/update' => 'admin/product/update',

      // 'admin/user' => 'admin/user/index',

      'admin/logout' => 'home/logout',
      'logout' => 'home/logout',

      '' => 'home/index',
      'home' => 'home/index',

      // 'register' => 'home/register',
      // 'login' => 'home/login',

   ];
?>