<?php require 'app/resource/views/admin/components/header.php'; ?>

<h4>Products</h4>

<h5>Create Product</h5>
<form action="product/change" method="post">
   <input type="number" name="id_status" value="<?= isset($id_status['id_status']) ? $id_status['id_status'] : '' ?>" placeholder="ID Status">
   <input type="text" name="name" value="<?= isset($name['name']) ? $name['name'] : '' ?>" placeholder="Name">
   <input type="text" name="description" value="<?= isset($description['description']) ? $description['description'] : '' ?>" placeholder="Description">
   <input type="text" name="main_image" value="<?= isset($main_image['main_image']) ? $main_image['main_image'] : '' ?>" placeholder="Image">
   <input type="number" name="quantity" value="<?= isset($quantity['quantity']) ? $quantity['quantity'] : '' ?>" placeholder="Quantity">
   <button type="submit" name="create">Create</button>
</form>

<h5>All Products</h5>
<!-- <table class="table_input">
   <thead>
      <tr>
         <th rowspan="2">ID</th>
         <th rowspan="2">Product</th>
         <th rowspan="2">Description</th>
         <th rowspan="2">Image</th>
         <th rowspan="2">Quantity</th>
         <th colspan="3">Prices</th>
      </tr>
      <tr>
         <th>Wholesale</th>
         <th>Retail</th>
         <th>Discount</th>
      </tr>
   </thead>
</table> -->
<?php foreach ($products as $product) { ?>
   <form action="product/change" method="post">
      <table class="table_input">
         <tbody>
            <tr class="inputs">
               <td><input type="number" name="id_product" value="<?= $product['id_product']; ?>" readonly></td>
               <td><input type="text" name="name" value="<?= $product['name']; ?>" readonly></td>
               <td><input type="text" name="description" value="<?= $product['description']; ?>" readonly></td>
               <td><input type="text" name="main_image" value="<?= $product['main_image']; ?>" readonly></td>
               <td><input type="number" name="quantity" value="<?= $product['quantity']; ?>" readonly></td>
               <td><input type="number" name="prices<?//= [1]['price'] ?>" value="<?= isset($product['prices'][1]) ? $product['prices'][1]['price'] : '' ?>" readonly></td>
               <td><input type="number" name="prices<?//= [2]['price'] ?>" value="<?= isset($product['prices'][2]) ? $product['prices'][2]['price'] : '' ?>" readonly></td>
               <td><input type="number" name="prices<?//= [3]['price'] ?>" value="<?= isset($product['prices'][3]) ? $product['prices'][3]['price'] : '' ?>" readonly></td>
               <td>
                  <button class="update" type="button">Update</button>
                  <button class="save" type="submit" style="display: none;" name="update">Save</button>
               </td>
               <td>
                  <button type="submit" name="delete" value="<?= $product['id_product'] ?>">Delete</button>
               </td>
            </tr>
         </tbody>
      </table>
   </form>
<?php } ?>

<script src='/app/resource/js/scripts.js'></script>
<?php require 'app/resource/views/admin/components/footer.php'; ?>