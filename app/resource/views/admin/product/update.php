<?php require 'app/resource/views/admin/components/header.php'; ?>

<h4>Update Product</h4>
<form action="" method="post" enctype="multipart/form-data">
   <p><b>Name: </b><input type="text" name="name" value="<?= $product['name'] ?>" placeholder="Name"></p>
   <div><b>Description: </b></div><p><textarea name="description" cols="30" rows="3" placeholder="Description"><?= $product['description'] ?></textarea></p>
   <p><b>Category: </b>
      <select name="id_category">
         <?php foreach ($allCategories as $category) { ?>
            <option value="<?= $category['id_category'] ?>" <?= isset($productCategory['id_category']) && $productCategory['id_category'] !== $category['id_category'] ?: 'selected' ?>><?= ucfirst($category['name']) ?></option>
         <?php } ?>
      </select>
   </p>
   <p><b>Status: </b>
      <select name="productStatus">
         <?php foreach ($allProductStatuses as $status) { ?>
            <option value="<?= $status['id_status'] ?>" <?= $status['id_status'] !== $product['id_status'] ?: 'selected' ?>><?= $status['name'] ?></option>
         <?php } ?>
      </select>
   </p>
   <p><b>Quantity: </b><input type="number" name="quantity" value="<?= $product['quantity'] ?>" placeholder="Quantity"></p>
   <?php foreach ($prices as $idPrice => $price) { ?>
      <div><b>Prices: </b></div>
      <p>
         <select name="priceStatus[<?= $idPrice ?>]">
            <?php foreach ($allPriceStatuses as $status) { ?>
               <option value="<?= $status['id_status'] ?>" <?= $status['id_status'] !== $prices[$idPrice]['id_status'] ?: 'selected' ?>><?= $status['name'] ?></option>
            <?php } ?>
         </select>
         <input type="number" name="price[<?= $idPrice ?>]" value="<?= $prices[$idPrice]['price'] ?? '' ?>" placeholder="Price">
         <button type="submit" name="deletePrice" value="<?= $idPrice ?>">Delete</button>
      </p>
   <?php } ?>
   <div><b>Add Price: </b></div>
   <p>
      <select name="newPriceStatus">
         <?php foreach ($allPriceStatuses as $status) { ?>
            <option value="<?= $status['id_status'] ?>"><?= $status['name'] ?></option>
         <?php } ?>
      </select>
      <input type="number" name="newPrice" placeholder="Price">
   </p>
   <div><?= $this->getImage([
               'name' => $product['main_image'],
               'alt' => $product['name'] . '_image',
               'class' => 'image',
               'id' => 'img' . $product['id_product'],
            ]); ?></div>
   <p><input type="file" name="main_image" value="<?= $product['main_image'] ?>"></p>
   <button type="submit" name="update" value="<?= $product['id_product'] ?>">Update</button>
   <a class="btn btn-secondary" href="<?= $this->getBaseURL('../products') ?>">Back</a>
</form>

<?php require 'app/resource/views/admin/components/footer.php'; ?>