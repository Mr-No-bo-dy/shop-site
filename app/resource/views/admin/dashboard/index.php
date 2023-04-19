<?php
   // require 'app/resource/views/home/components/header.php';
?>

<?php 
   var_dump($_SESSION);
   $adminName = $_SESSION['users']['admin'];
?>
   <p>Hello, admin <b><?= $adminName ?></b></p>

<?php 
   // require 'app/resource/views/home/components/footer.php'; 
?>