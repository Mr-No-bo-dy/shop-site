<?php require 'app/resource/views/admin/components/header.php'; ?>

<h1 class="h3">Create Product</h1>
<form action="" method="post" enctype="multipart/form-data">
   <p><b>Name: </b><input type="text" name="name" value="<?= $_POST['name'] ?? '' ?>" placeholder="Name"></p>
   <div><b>Description: </b></div><p><textarea name="description" cols="30" rows="3" placeholder="Description"><?= $_POST['description'] ?? '' ?></textarea></p>
   <p><b>Category: </b>
      <select name="id_category">
         <?php foreach ($allCategories as $category) { ?>
            <option value="<?= $category['id_category'] ?>"><?= ucfirst($category['name']) ?></option>
         <?php } ?>
      </select>
   </p>
   <p><b>Status: </b>
      <select name="productStatus">
         <?php foreach ($allProductStatuses as $status) { ?>
            <option value="<?= $status['id_status'] ?>"><?= ucfirst($status['name']) ?></option>
         <?php } ?>
      </select>
   </p>
   <p><b>Quantity: </b><input type="number" name="quantity" value="<?= $_POST['quantity'] ?? '' ?>" placeholder="Quantity"></p>
   <div><b>Price: </b></div>
   <p>
      <select name="priceStatus">
         <?php foreach ($allPriceStatuses as $status) { ?>
            <option value="<?= $status['id_status'] ?>"><?= ucfirst($status['name']) ?></option>
         <?php } ?>
      </select>
      <input type="number" name="price" value="<?= $_POST['price'] ?? '' ?>" placeholder="Price">
   </p>
   <p><input type="file" name="main_image"></p>
   <button class="btn btn-primary" type="submit" name="create" value="1">Create</button>
   <a class="btn btn-secondary" href="<?= $this->getBaseURL('products') ?>">Cancel</a>
</form>

<?php require 'app/resource/views/admin/components/footer.php'; ?>