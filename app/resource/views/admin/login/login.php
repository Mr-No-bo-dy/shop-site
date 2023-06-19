<?php require 'app/resource/views/home/components/header.php'; ?>

<div class="mx-auto d-table h-100 col-xl-4 col-lg-6 col-md-7 col-sm-9 col-11">
   <div class="d-table-cell align-middle">
      <div class="text-center my-2">
         <h1 class="h2">Login</h1>
      </div>
      <div class="card mb-4 bg-secondary shadow-lg">
         <div class="card-body">
            <div class="m-sm-4">
               <form action="<?= $this->getBaseURL('login') ?>" method="post" enctype="multipart/form-data">
                  <div class="text-danger"><?= $errors['login_pass']['desc'] ?? '' ?></div>
                  <div class="mb-3">
                     <label>Username</label><input class="form-control <?= isset($errors['login']['check']) ? 'is-invalid' : '' ?>" type="text" name="login" value="<?= $_POST['login'] ?? '' ?>" placeholder="Enter Username">
                     <div class="invalid-feedback"><?= $errors['login']['desc'] ?? '' ?></div>
                  </div>
                  <div>
                     <label>Password</label><input class="form-control <?= isset($errors['password']['check']) ? 'is-invalid' : '' ?>" type="password" name="password" value="<?= $_POST['password'] ?? '' ?>" placeholder="Enter Password">
                     <div class="invalid-feedback"><?= $errors['password']['desc'] ?? '' ?></div>
                  </div>
                  <div class="text-center mt-4"><button class="btn btn-primary btn-lg" type="submit">Login</button></div>
                  <!-- <div class="text-center mt-3"><a class="btn btn-secondary" href="register">Register</a></div> -->
               </form>
            </div>
         </div>
      </div>
   </div>
</div>

<?php require 'app/resource/views/home/components/footer.php'; ?>