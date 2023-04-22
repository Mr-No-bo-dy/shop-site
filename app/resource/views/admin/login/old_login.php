<?php
   require 'app/resource/views/home/components/header.php';
?>

<div class="wrapper">
   <div class="wrapper-form">
      <h1>Login</h1>
      <div><a class="button" href="register">Register</a></div>
      <form class="verify" action="login" method="post">
         <input class="<?= $fieldsError ? 'error' : '' ?>" type="text" name="login" value="<?= empty($_POST['login']) ? '' : $_POST['login'] ?>" placeholder="Enter login">
         <input class="<?= $fieldsError ? 'error' : '' ?>" type="password" name="password" value="<?= empty($_POST['password']) ? '' : $_POST['password'] ?>" placeholder="Enter Password">
         <button class="button" type="submit">Login</button>
      </form>
   </div>
</div>

<?php 
   require 'app/resource/views/home/components/footer.php'; 
?>