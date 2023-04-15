<?php
   require 'app/resource/views/home/components/header.php';
   // require '_temp/error_login.php';
?>

<div class="wrapper">
   <div class="wrapper-form">
      <h1>Login</h1>
      <div><a class="button" href="register">Register</a></div>
      <form class="verify" action="admin" method="post">
         <?php if (!empty($errorText)) { ?>
            <span class="error-unique"><?= $errorText ?></span>
         <?php } ?>
         <input class="<?= $fieldsError ? 'error-input' : '' ?>" type="text" name="username" value="<?= empty($_POST['username']) ? '' : $_POST['username'] ?>" placeholder="Enter Username">
         <input class="<?= $fieldsError ? 'error-input' : '' ?>" type="password" name="password" value="<?= empty($_POST['password']) ? '' : $_POST['password'] ?>" placeholder="Enter Password">
         <button class="button" type="submit">Login</button>
      </form>
   </div>
</div>

<?php 
   require 'app/resource/views/home/components/footer.php'; 
?>