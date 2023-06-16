<?php require 'app/resource/views/admin/components/header.php'; ?>

<div class="mx-auto d-table h-100 col-xl-4 col-lg-6 col-md-7 col-sm-9 col-11">
   <div class="d-table-cell align-middle">
      <div class="text-center mt-2">
         <h1 class="h2">Registration</h1>
      </div>
      <div class="card mb-4 bg-secondary shadow-lg">
         <div class="card-body">
            <div class="m-sm-4">
               <form action="<?= $this->getBaseURL('register') ?>" method="post" enctype="multipart/form-data">
                  <div class="mb-3">
                     <label>Username</label><input class="form-control <?= isset($errors['login']['check']) ? 'is-invalid' : 'was-validated' ?>" type="text" name="login" value="<?= $_POST['login'] ?? '' ?>" placeholder="Enter Username">
                     <div class="invalid-feedback"><?= $errors['login']['desc'] ?? '' ?></div>
                  </div>
                  <div class="mb-3">
                     <label>Password</label><input class="form-control <?= isset($errors['password']['check']) ? 'is-invalid' : 'was-validated' ?>" type="password" name="password" value="<?= $_POST['password'] ?? '' ?>" placeholder="Enter Password">
                     <div class="invalid-feedback"><?= $errors['password']['desc'] ?? '' ?></div>
                  </div>
                  <div class="mb-3">
                     <label>First Name</label><input class="form-control <?= isset($errors['first_name']['check']) ? 'is-invalid' : 'was-validated' ?>" type="text" name="first_name" value="<?= $_POST['first_name'] ?? '' ?>" placeholder="Enter First Name">
                     <div class="invalid-feedback"><?= $errors['first_name']['desc'] ?? '' ?></div>
                  </div>
                  <div class="mb-3">
                     <label>Last Name</label><input class="form-control <?= isset($errors['last_name']['check']) ? 'is-invalid' : 'was-validated' ?>" type="text" name="last_name" value="<?= $_POST['last_name'] ?? '' ?>" placeholder="Enter Last Name">
                     <div class="invalid-feedback"><?= $errors['last_name']['desc'] ?? '' ?></div>
                  </div>
                  <div class="mb-3">
                     <label>Phone</label><input class="form-control <?= isset($errors['phone']['check']) ? 'is-invalid' : 'was-validated' ?>" type="number" name="phone" value="<?= $_POST['phone'] ?? '' ?>" placeholder="Enter Phone ">
                     <div class="invalid-feedback"><?= $errors['phone']['desc'] ?? '' ?></div>
                  </div>
                  <div class="mb-3">
                     <label>Email</label><input class="form-control <?= isset($errors['email']['check']) ? 'is-invalid' : 'was-validated' ?>" type="email" name="email" value="<?= $_POST['email'] ?? '' ?>" placeholder="Enter Email">
                     <div class="invalid-feedback"><?= $errors['email']['desc'] ?? '' ?></div>
                  </div>
                  <div class="mb-3">
                     <label>Status</label><input class="form-control <?= isset($errors['id_status']['check']) ? 'is-invalid' : 'was-validated' ?>" type="number" name="id_status" value="<?= $_POST['id_status'] ?? '' ?>" placeholder="Enter Status ID">
                     <div class="invalid-feedback"><?= $errors['id_status']['desc'] ?? '' ?></div>
                  </div>
                  <div class="text-center mt-4"><button class="btn btn-primary btn-lg" type="submit">Register</button></div>
                  <!-- <div class="text-center mt-3"><a class="btn btn-secondary" href="login">Login</a></div> -->
               </form>
            </div>
         </div>
      </div>
   </div>
</div>

<?php require 'app/resource/views/admin/components/footer.php'; ?>