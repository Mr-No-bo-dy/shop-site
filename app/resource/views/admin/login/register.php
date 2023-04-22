<?php
   require 'app/resource/views/home/components/header.php';
?>

<div class="wrapper">
   <div class="wrapper-form">
      <h1>Registration</h1>
      <div><a class="button" href="login">Login</a></div>
      <form class="verify" action="register" method="post" enctype="multipart/form-data">
         <div>
            <label>Username<input class="<?//= isset($errors['login']['check']) ? 'er_text' : '' ?>" type="text" name="login" value="<?= $_POST['login'] ?? '' ?>" placeholder="Enter Username"></label>
            <div class="er_text"><?= $errors['login']['desc'] ?? '' ?></div>
         </div>
         <div>
            <label>Password<input class="<?//= isset($errors['password']['check']) ? 'er_text' : '' ?>" type="password" name="password" value="<?= $_POST['password'] ?? '' ?>" placeholder="Enter Password"></label>
            <div class="er_text"><?= $errors['password']['desc'] ?? '' ?></div>
         </div>
         <div>
            <label>First Name<input class="<?//= isset($errors['first_name']['check']) ? 'er_text' : '' ?>" type="text" name="first_name" value="<?= $_POST['first_name'] ?? '' ?>" placeholder="Enter First Name"></label>
            <div class="er_text"><?= $errors['first_name']['desc'] ?? '' ?></div>
         </div>
         <div>
            <label>Last Name<input class="<?//= isset($errors['last_name']['check']) ? 'er_text' : '' ?>" type="text" name="last_name" value="<?= $_POST['last_name'] ?? '' ?>" placeholder="Enter Last Name"></label>
            <div class="er_text"><?= $errors['last_name']['desc'] ?? '' ?></div>
         </div>
         <div>
            <label>Phone<input class="<?//= isset($errors['phone']['check']) ? 'er_text' : '' ?>" type="number" name="phone" value="<?= $_POST['phone'] ?? '' ?>" placeholder="Enter Phone "></label>
            <div class="er_text"><?= $errors['phone']['desc'] ?? '' ?></div>
         </div>
         <div>
            <label>Email<input class="<?//= isset($errors['email']['check']) ? 'er_text' : '' ?>" type="email" name="email" value="<?= $_POST['email'] ?? '' ?>" placeholder="Enter Email"></label>
            <div class="er_text"><?= $errors['email']['desc'] ?? '' ?></div>
         </div>
         <div>
            <label>ID Status<input class="<?//= isset($errors['id_status']['check']) ? 'er_text' : '' ?>" type="number" name="id_status" value="<?= $_POST['id_status'] ?? '' ?>" placeholder="Enter ID Status"></label>
            <div class="er_text"><?= $errors['id_status']['desc'] ?? '' ?></div>
         </div>
         <button class="button" type="submit">Register</button>
      </form>
   </div>
</div>

<?php 
   require 'app/resource/views/home/components/footer.php'; 
?>