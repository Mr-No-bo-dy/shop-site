<?php require 'app/resource/views/admin/components/header.php'; ?>

<h1 class="h3">Statuses</h1>

<h2 class="my-2 h5">Create Status</h2>
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

<h2 class="my-2 h5">All Statuses</h2>
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