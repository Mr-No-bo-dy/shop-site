<?php
   require 'app/resource/views/home/components/header.php';
?>

<?php 
   if (isset($_SESSION['users']['admin'])) {
      // header('Location: app/resource/views/admin/dashboard/index.php');
      // header('Location: admin');
   } else {
      // header('Location: app/resource/views/admin/register/login.php');
      header('Location: login');
   }
   $adminName = $_SESSION['users']['admin'];
?>
   <p>Hello, admin <b><?= $adminName ?></b></p>

<?php 
   require 'app/resource/views/home/components/footer.php'; 
?>