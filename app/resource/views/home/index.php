<?php 
   require ("app/resource/views/home/components/header.php");
   // require ("_temp/error_register.php");
?>

<?php 
   if (isset($_POST['username'])) {
      $_SESSION['users']['adminLoginUser'] = $_POST['username'];
      header("Location: admin");
   } else {
      // header("Location: login");
   }

   
   // if (isset($_POST['username']) && isset($_POST['password']) && $_POST['username'] === 'olex') {
   // if (isset($_POST['username'])) {
   //    // $action = 'admin';
   // } else {
   //    // $fieldsError = true;
   // }
?>
   <h2>Welcome to Shop, User</h2>

<?php 
   require ("app/resource/views/home/components/footer.php"); 
?>