<?php require 'app/resource/views/admin/components/header.php'; ?>

<h1 class="h4">Categories</h1>

<h2 class="my-2 h5">Create Category</h2>
<form action="<?= $this->getBaseURL('category') ?>" method="post">
   <div>
      <input class="<?= isset($errors['name']['check']) ? 'is-invalid' : '' ?>" type="text" name="name" value="<?= $_POST['name'] ?? '' ?>" placeholder="Name">
      <div class="invalid-feedback"><?= $errors['name']['desc'] ?? '' ?></div>
   </div>
   <div>
      <textarea class="<?= isset($errors['description']['check']) ? 'is-invalid' : '' ?>" name="description" cols="23" rows="3" placeholder="Description"><?= $_POST['description'] ?? '' ?></textarea>
      <div class="invalid-feedback"><?= $errors['description']['desc'] ?? '' ?></div>
   </div>
   <button type="submit" name="create">Create</button>
</form>

<h2 class="my-2 h5">All Categories</h2>
<!-- <table class="table_input">
   <thead>
      <tr class="inputs">
         <th>ID</th>
         <th>Name</th>
         <th>Description</th>
         <th>Update</th>
         <th>Delete</th>
      </tr>
   </thead>
</table> -->
<?php foreach ($allCategories as $category) { ?>
   <form action="<?= $this->getBaseURL('category') ?>" method="post">
      <table class="table_input">
         <tbody>
            <tr class="inputs">
               <td><input type="number" name="id_category" value="<?= $category['id_category']; ?>" readonly></td>
               <td><input type="text" name="name" value="<?= ucfirst($category['name']); ?>" readonly></td>
               <td><input type="text" name="description" value="<?= $category['description']; ?>" readonly></td>
               <td>
                  <button class="update" type="button">Update</button>
                  <button class="save" type="submit" style="display: none;" name="update">Save</button>
               </td>
               <td>
                  <button type="submit" name="delete" value="<?= $category['id_category'] ?>">Delete</button>
               </td>
            </tr>
         </tbody>
      </table>
   </form>
<?php } ?>

<?php require 'app/resource/views/admin/components/footer.php'; ?>