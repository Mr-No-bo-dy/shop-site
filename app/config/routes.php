<?php 
   $urlRoutes = [
      // request (in URL) => ( dir / ) controller / method

      // admin
      'admin' => 'admin/admin/index',
      'admin/dashboard' => 'admin/admin/index',
      'admin/register' => 'admin/admin/register',
      'admin/login' => 'admin/admin/login',
      'admin/logout' => 'site/home/logout',
      
      // admin: status, category, subcategory, orders
      'admin/status' => 'admin/status/check',
      'admin/category' => 'admin/category/check',
      'admin/subcategory' => 'admin/subcategory/check',
      'admin/orders' => 'admin/order/check',

      // admin - products
      'admin/products' => 'admin/product/index',
      'admin/product' => 'admin/product/view',
      'admin/product/show' => 'admin/product/show',   // for AJAX
      'admin/product/create' => 'admin/product/create',
      'admin/product/update' => 'admin/product/update',
      'admin/product/delete' => 'admin/product/delete',
      
      // site - login
      'home/register' => 'site/home/register',
      'home/login' => 'site/home/login',
      'home/logout' => 'site/home/logout',

      // site
      // '' => 'site/home/index',      // Якщо URI буде без home - інші маршрути НЕ будуть працювати. Треба зробити додавання home/ до URI
      'home' => 'site/home/index',
      'home/index' => 'site/home/index',
      'home/filtered' => 'site/home/filtered',
      'home/cart' => 'site/home/cart',
      'home/createOrder' => 'site/home/createOrder',
      'home/order' => 'site/home/order',
   ];
?>