<?php
   require ("app/resource/views/home/components/header.php");
?>

<?php 
   if (isset($_SESSION['users']['adminLoginUser'])) {
      // header("Location: app/resource/views/admin/dashboard/index.php");
      // header("Location: admin");
   } else {
      // header("Location: app/resource/views/admin/register/login.php");
      header("Location: login");
   }
   $adminName = $_SESSION['users']['adminLoginUser'];
?>
   <h1>Hello, admin <?= $adminName ?></h1>

<?php 
   require ("app/resource/views/home/components/footer.php"); 
?>