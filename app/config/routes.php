<?php 
   $urlRoutes = [
      // request (in URL) => ( dir / ) controller / method

      // 'admin/admin' => 'admin/admin/index',
      // 'admin/dashboard' => 'admin/admin/index',
      'admin' => 'admin/admin/index',

      'admin/register' => 'admin/admin/register',
      'admin/login' => 'admin/admin/login',
      'admin/logout' => 'site/home/logout',
      'logout' => 'site/home/logout',
      
      'admin/status' => 'admin/status/check',
      'admin/category' => 'admin/category/check',
      'admin/subcategory' => 'admin/subcategory/check',

      'admin/products' => 'admin/product/index',
      'admin/product' => 'admin/product/view',
      'admin/product/create' => 'admin/product/create',
      'admin/product/update' => 'admin/product/update',
      'admin/product/delete' => 'admin/product/delete',

      '' => 'site/home/index',
      'home' => 'site/home/index',
      'home/view' => 'site/home/view',
      'home/cart' => 'site/home/cart',

      // 'register' => 'home/register',
      // 'login' => 'home/login',

   ];
?>