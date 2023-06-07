<?php 
   $urlRoutes = [
      // request (in URL) => ( dir / ) controller / method

      // admin
      'admin' => 'admin/admin/index',
      'admin/dashboard' => 'admin/admin/index',
      'admin/register' => 'admin/admin/register',
      'admin/login' => 'admin/admin/login',
      'admin/logout' => 'site/home/logout',
      
      // admin: status, category, subcategory
      'admin/status' => 'admin/status/check',
      'admin/category' => 'admin/category/check',
      'admin/subcategory' => 'admin/subcategory/check',

      // admin - products
      'admin/products' => 'admin/product/index',
      'admin/product' => 'admin/product/view',
      'admin/product/create' => 'admin/product/create',
      'admin/product/update' => 'admin/product/update',
      'admin/product/delete' => 'admin/product/delete',

      // site
      '' => 'site/home/index',
      'home' => 'site/home/index',
      'home/filtered' => 'site/home/filtered',
      'home/cart' => 'site/home/cart',
      'home/createOrder' => 'site/home/createOrder',
      'home/order' => 'site/home/order',

      // 'register' => 'site/home/register',
      'login' => 'site/home/login',
      'logout' => 'site/home/logout',

   ];
?>