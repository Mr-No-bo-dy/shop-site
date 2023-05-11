<?php require 'app/resource/views/admin/components/header.php'; ?>

<h4>Statuses</h4>

<h5>Create Category</h5>
<form action="status/change" method="post">
   <input type="text" name="name" value="<?= isset($name['name']) ? $name['name'] : '' ?>" placeholder="Status Name">
   <input type="text" name="category" value="<?= isset($category['category']) ? $category['category'] : '' ?>" placeholder="Status Category">
   <button type="submit" name="create">Create</button>
</form>

<h5>All Categories</h5>
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
   <form action="status/change" method="post">
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

<script src='/app/resource/js/scripts.js'></script>
<?php require 'app/resource/views/admin/components/footer.php'; ?>