<?php
   require 'app/resource/views/home/components/header.php';
?>

<div class="wrapper">
   <div class="wrapper-form">
      <h1>Login</h1>
      <div><a class="button" href="register">Register</a></div>
      <form class="verify" action="login" method="post" enctype="multipart/form-data">
         <div>
            <label>Username<input class="<?//= isset($errors['login']['check']) ? 'er_text' : '' ?>" type="text" name="login" value="<?= $_POST['login'] ?? '' ?>" placeholder="Enter Username"></label>
            <div class="er_text"><?= $errors['login']['desc'] ?? '' ?></div>
         </div>
         <div>
            <label>Password<input class="<?//= isset($errors['password']['check']) ? 'er_text' : '' ?>" type="password" name="password" value="<?= $_POST['password'] ?? '' ?>" placeholder="Enter Password"></label>
            <div class="er_text"><?= $errors['password']['desc'] ?? '' ?></div>
         </div>
         <button class="button" type="submit">Login</button>
      </form>
   </div>
</div>

<?php 
   require 'app/resource/views/home/components/footer.php'; 
?>