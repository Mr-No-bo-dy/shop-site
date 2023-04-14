<?php
   require ("app/resource/views/home/components/header.php");
   // require ("_temp/error_register.php");
?>

<div class="wrapper">
   <div class="wrapper-form">
      <h1>Registration</h1>
      <h3><a class="button" href="login">Login</a></h3>
      <form class="verify" action="register" method="post" enctype="multipart/form-data">
         <?php if (!empty($errorText)) { ?>
            <span class="error-unique"><?= $errorText ?></span>
         <?php } ?>
         <input class="<?= $fieldsError ? 'error-input' : '' ?>" type="text" name="login" value="<?= empty($_POST['login']) ? '' : $_POST['login'] ?>" placeholder="Enter Username">
         <input class="<?= $fieldsError ? 'error-input' : '' ?>" type="password" name="password" value="<?= empty($_POST['password']) ? '' : $_POST['password'] ?>" placeholder="Enter Password">
         <input class="<?= $fieldsError ? 'error-input' : '' ?>" type="text" name="first_name" value="<?= empty($_POST['first_name']) ? '' : $_POST['first_name'] ?>" placeholder="Enter First Name">
         <input class="<?= $fieldsError ? 'error-input' : '' ?>" type="text" name="last_name" value="<?= empty($_POST['last_name']) ? '' : $_POST['last_name'] ?>" placeholder="Enter Last Name">
         <input class="<?= $fieldsError ? 'error-input' : '' ?>" type="phone" name="phone" value="<?= empty($_POST['phone']) ? '' : $_POST['phone'] ?>" placeholder="Enter Phone ">
         <input class="<?= $fieldsError ? 'error-input' : '' ?>" type="email" name="email" value="<?= empty($_POST['email']) ? '' : $_POST['email'] ?>" placeholder="Enter Email">
         <input class="<?= $fieldsError ? 'error-input' : '' ?>" type="text" name="id_status" value="<?= empty($_POST['id_status']) ? '' : $_POST['id_status'] ?>" placeholder="Enter ID Status ">
         <!-- <input type="file" name="avatar"> -->
         <button class="button" type="submit">Register</button>
      </form>
   </div>
</div>

<?php 
   require ("app/resource/views/home/components/footer.php"); 
?>