<?php
   require ("components/header.php");
   require ("_temp/error_register.php");
?>

<div class="wrapper">
   <div class="wrapper-form">
      <h1>Registration</h1>
      <h3><a class="button" href="login.php">Login</a></h3>
      <form class="verify" action="<?= $action ?>" method="post" enctype="multipart/form-data">
         <?php if (!empty($errorText)) { ?>
            <span class="error-unique"><?= $errorText ?></span>
         <?php } ?>
         <input class="<?= $fieldsError ? 'error-input' : ($userUniqueError ? 'error-unique' : '') ?>" type="text" name="username" value="<?= empty($_POST['username']) ? '' : $_POST['username'] ?>" placeholder="Enter Username">
         <input class="<?= $fieldsError ? 'error-input' : '' ?>" type="password" name="password" value="<?= empty($_POST['password']) ? '' : $_POST['password'] ?>" placeholder="Enter Password">
         <input class="<?= $fieldsError ? 'error-input' : '' ?>" type="email" name="email" value="<?= empty($_POST['email']) ? '' : $_POST['email'] ?>" placeholder="Enter Email">
         <input class="<?= $fieldsError ? 'error-input' : '' ?>" type="tel" name="tel" value="<?= empty($_POST['tel']) ? '' : $_POST['tel'] ?>" placeholder="Enter Phone ">
         <input type="file" name="avatar">
         <button class="button" type="submit">Register</button>
      </form>
   </div>
</div>

<?php 
   require ("components/footer.php"); 
?>