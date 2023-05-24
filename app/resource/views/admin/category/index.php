<?php require 'app/resource/views/admin/components/header.php'; ?>

<h4>Categories</h4>

<h5 class="mt-3">Create Category</h5>
<form action="<?= $this->getBaseURL('category') ?>" method="post">
   <div>
      <input class="<?= isset($errors['name']['check']) ? 'is-invalid' : '' ?>" type="text" name="name" value="<?= $name['name'] ?? '' ?>" placeholder="Name">
      <div class="invalid-feedback"><?= $errors['name']['desc'] ?? '' ?></div>
   </div>
   <div>
      <textarea class="<?= isset($errors['description']['check']) ? 'is-invalid' : '' ?>" name="description" value="<?= $description['description'] ?? '' ?>"  cols="23" rows="3" placeholder="Description"></textarea>
      <div class="invalid-feedback"><?= $errors['description']['desc'] ?? '' ?></div>
   </div>
   <button type="submit" name="create">Create</button>
</form>

<h5 class="mt-3">All Categories</h5>
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
               <td><input type="text" name="name" value="<?= $category['name']; ?>" readonly></td>
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