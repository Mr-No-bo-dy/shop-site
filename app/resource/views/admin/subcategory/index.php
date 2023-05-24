<?php require 'app/resource/views/admin/components/header.php'; ?>

<h4>SubCategories</h4>

<h5 class="mt-3">Create SubCategory</h5>
<form action="<?= $this->getBaseURL('subcategory') ?>" method="post">
   <div>
      <select name="id_category">
         <?php foreach ($allCategories as $category) { ?>
            <option value="<?= $category['id_category'] ?>"><?= ucfirst($category['name']) ?></option>
         <?php } ?>
      </select>
   </div>
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

<h5 class="mt-3">All SubCategories</h5>
<!-- <table class="table_input">
   <thead>
      <tr class="inputs">
         <th>ID</th>
         <th>Category Name</th>
         <th>Name</th>
         <th>Description</th>
         <th>Update</th>
         <th>Delete</th>
      </tr>
   </thead>
</table> -->
<?php foreach ($setSubCategories as $subCategory) { ?>
   <form action="<?= $this->getBaseURL('subcategory') ?>" method="post">
      <table class="table_input">
         <tbody>
            <tr class="inputs">
               <td><input type="number" name="id_sub_category" value="<?= $subCategory['id_sub_category']; ?>" readonly></td>
               <td>
                  <select name="id_category" disabled>
                     <?php foreach ($allCategories as $category) { ?>
                        <option value="<?= $category['id_category'] ?>" <?= $subCategory['id_category'] !== $category['id_category'] ?: 'selected' ?>><?= ucfirst($category['name']) ?></option>
                     <?php } ?>
                  </select>
               </td>
               <td><input type="text" name="name" value="<?= $subCategory['name']; ?>" readonly></td>
               <td><input type="text" name="description" value="<?= $subCategory['description']; ?>" readonly></td>
               <td>
                  <button class="update" type="button">Update</button>
                  <button class="save" type="submit" style="display: none;" name="update">Save</button>
               </td>
               <td>
                  <button type="submit" name="delete" value="<?= $subCategory['id_sub_category'] ?>">Delete</button>
               </td>
            </tr>
         </tbody>
      </table>
   </form>
<?php } ?>

<?php require 'app/resource/views/admin/components/footer.php'; ?>