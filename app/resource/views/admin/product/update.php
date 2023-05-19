<?php require 'app/resource/views/admin/components/header.php'; ?>

<a href="<?= $this->getBaseURL('../products') ?>">View All Products</a>

<h4>Update Product</h4>
<form action="" method="post" enctype="multipart/form-data">
   <p><b>Name: </b><input type="text" name="name" value="<?= $product['name'] ?>" placeholder="Name"></p>
   <p><b>Status: </b>
      <select name="productStatus">
         <?php foreach ($allProductStatuses as $status) { ?>
            <option value="<?= $status['id_status'] ?>" <?= $status['id_status'] !== $product['id_status'] ?: 'selected' ?>><?= $status['name'] ?></option>
         <?php } ?>
      </select>
   </p>
   <div><b>Description: </b></div><textarea name="description" cols="30" rows="3" placeholder="Description"><?= $product['description'] ?></textarea>
   <p><b>Quantity: </b><input type="number" name="quantity" value="<?= $product['quantity'] ?>" placeholder="Quantity"></p>
   <?php foreach ($prices as $idPrice => $price) { ?>
   <p><b>Price: </b>
      <select name="priceStatus[<?= $idPrice ?>]">
         <?php foreach ($allPriceStatuses as $status) { ?>
            <option value="<?= $status['id_status'] ?>" <?= $status['id_status'] !== $prices[$idPrice]['id_status'] ?: 'selected' ?>><?= $status['name'] ?></option>
         <?php } ?>
      </select>
      <input type="number" name="price[<?= $idPrice ?>]" value="<?= $prices[$idPrice]['price'] ?? '' ?>" placeholder="Price">
   </p>
   <?php } ?>
   <div><?= $this->getImage([
               'name' => $product['main_image'],
               'alt' => $product['name'] . '_image',
               'class' => 'image',
               'id' => 'img' . $product['id_product'],
            ]); ?></div>
   <p><input type="file" name="main_image" value="<?= $product['main_image'] ?>"></p>
   <input type="hidden" name="id_product" value="<?= $product['id_product'] ?>">
   <button type="submit" name="update" value="2">Update</button>
</form>

<?php require 'app/resource/views/admin/components/footer.php'; ?>