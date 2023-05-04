<?php 
   $urlRoutes = [
      // request (in URL) => ( dir / ) controller / method

      // 'admin' => 'admin/admin/index',
      'admin/admin' => 'admin/admin/index',
      'admin/dashboard' => 'admin/admin/index',
      'admin/register' => 'admin/admin/register',
      'admin/login' => 'admin/admin/login',
      
      'admin/status' => 'admin/status/index',
      'admin/status/create' => 'admin/status/create',
      'admin/status/change' => 'admin/status/change',
      // 'admin/status/update' => 'admin/status/update',
      // 'admin/status/delete' => 'admin/status/delete',

      'admin/logout' => 'home/logout',
      'logout' => 'home/logout',

      '' => 'home/index',
      'home' => 'home/index',

      // 'register' => 'home/register',
      // 'login' => 'home/login',

   ];
?>