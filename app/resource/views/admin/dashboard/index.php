<?php require 'app/resource/views/admin/components/header.php'; ?>

<?php 
   // echo '<pre>';
   // var_dump($user);
   // echo '</pre>';
?>
   <p>Hello, admin <b><?= $_SESSION['user']['login'] ?></b></p>

<?php require 'app/resource/views/admin/components/footer.php'; ?>