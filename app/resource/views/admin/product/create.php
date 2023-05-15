<?php require 'app/resource/views/admin/components/header.php'; ?>

<h4>Create Product</h4>
<form action="" method="post" enctype="multipart/form-data">
   <p><input type="text" name="name" value="<?= isset($name['name']) ? $name['name'] : '' ?>" placeholder="Name"></p>
   <p>
      <select name="productStatus">
         <?php foreach ($productStatuses as $status) { ?>
            <option value="<?= $status['id_status'] ?>"><?= $status['name'] ?></option>
         <?php } ?>
      </select>
   </p>
   <p><input type="text" name="description" value="<?= isset($description['description']) ? $description['description'] : '' ?>" placeholder="Description"></p>
   <p><input type="number" name="quantity" value="<?= isset($quantity['quantity']) ? $quantity['quantity'] : '' ?>" placeholder="Quantity"></p>
   <p>
      <select name="pricetStatus">
         <?php foreach ($priceStatuses as $status) { ?>
            <option value="<?= $status['id_status'] ?>"><?= $status['name'] ?></option>
         <?php } ?>
      </select>
      <input type="number" name="price" value="<?= isset($price['price']) ? $price['price'] : '' ?>" placeholder="Price">
   </p>
   <p><input type="file" name="main_image"></p>
   <button type="submit" name="create" value="1">Create</button>
</form>

<?php require 'app/resource/views/admin/components/footer.php'; ?>