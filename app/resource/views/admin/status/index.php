<?php require 'app/resource/views/admin/components/header.php'; ?>

<h4>Statuses</h4>

<h5 class="mt-3">Create Status</h5>
<!-- <form action="<?//= $this->getBaseURL('status/check') ?>" method="post"> -->
<form action="<?= $this->getBaseURL('status') ?>" method="post">
   <div>
      <input class="<?= isset($errors['name']['check']) ? 'is-invalid' : '' ?>" type="text" name="name" value="<?= $_POST['name'] ?? '' ?>" placeholder="Name">
      <div class="invalid-feedback"><?= $errors['name']['desc'] ?? '' ?></div>
   </div>
   <div>
      <input class="<?= isset($errors['category']['check']) ? 'is-invalid' : '' ?>" type="text" name="category" value="<?= $_POST['category'] ?? '' ?>" placeholder="Category">
      <div class="invalid-feedback"><?= $errors['category']['desc'] ?? '' ?></div>
   </div>
   <button type="submit" name="create">Create</button>
</form>

<h5 class="mt-3">All Statuses</h5>
<!-- <table class="table_input">
   <thead>
      <tr class="inputs">
         <th>ID</th>
         <th>Name</th>
         <th>Category</th>
         <th>Update</th>
         <th>Delete</th>
      </tr>
   </thead>
</table> -->
<?php foreach ($allStatuses as $status) { ?>
   <!-- <form action="<?//= $this->getBaseURL('status/check') ?>" method="post"> -->
   <form action="<?= $this->getBaseURL('status') ?>" method="post">
      <table class="table_input">
         <tbody>
            <tr class="inputs">
               <td><input type="number" name="id_status" value="<?= $status['id_status']; ?>" readonly></td>
               <td><input type="text" name="name" value="<?= $status['name']; ?>" readonly></td>
               <td><input type="text" name="category" value="<?= $status['category']; ?>" readonly></td>
               <td>
                  <button class="update" type="button">Update</button>
                  <button class="save" type="submit" style="display: none;" name="update">Save</button>
               </td>
               <td>
                  <button type="submit" name="delete" value="<?= $status['id_status'] ?>">Delete</button>
               </td>
            </tr>
         </tbody>
      </table>
   </form>
<?php } ?>

<?php require 'app/resource/views/admin/components/footer.php'; ?>