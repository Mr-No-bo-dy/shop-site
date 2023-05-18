<?php require 'app/resource/views/admin/components/header.php'; ?>

<h4>Create Product</h4>
<form action="" method="post" enctype="multipart/form-data">
   <p><b>Name: </b><input type="text" name="name" value="<?= $_POST['name'] ?? '' ?>" placeholder="Name"></p>
   <p><b>Status: </b>
      <select name="productStatus">
         <?php foreach ($allProductStatuses as $status) { ?>
            <option value="<?= $status['id_status'] ?>"><?= $status['name'] ?></option>
         <?php } ?>
      </select>
   </p>
   <div><b>Description: </b></div><textarea name="description" cols="30" rows="3" placeholder="Description"><?= $_POST['description'] ?? '' ?></textarea>
   <p><b>Quantity: </b><input type="number" name="quantity" value="<?= $_POST['quantity'] ?? '' ?>" placeholder="Quantity"></p>
   <p><b>Price: </b>
      <select name="priceStatus">
         <?php foreach ($allPriceStatuses as $status) { ?>
            <option value="<?= $status['id_status'] ?>"><?= $status['name'] ?></option>
         <?php } ?>
      </select>
      <input type="number" name="price" value="<?= $_POST['price'] ?? '' ?>" placeholder="Price">
   </p>
   <p><input type="file" name="main_image"></p>
   <button type="submit" name="create" value="1">Create</button>
</form>

<?php require 'app/resource/views/admin/components/footer.php'; ?>