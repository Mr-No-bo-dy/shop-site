<?php require 'app/resource/views/admin/components/header.php'; ?>

<h1 class="h4">Update Product</h1>
<form action="" method="post" enctype="multipart/form-data">
   <p><b>Name: </b><input type="text" name="name" value="<?= $product['name'] ?>" placeholder="Name"></p>
   <div><b>Description: </b></div><p><textarea name="description" cols="30" rows="3" placeholder="Description"><?= $product['description'] ?></textarea></p>
   <p><b>Category: </b>
      <select name="id_category">
         <?php foreach ($allCategories as $category) { ?>
            <option value="<?= $category['id_category'] ?>" <?= isset($idCategory) && $idCategory !== $category['id_category'] ?: 'selected' ?>><?= ucfirst($category['name']) ?></option>
         <?php } ?>
      </select>
   </p>
   <p><b>Status: </b>
      <select name="productStatus">
         <?php foreach ($allProductStatuses as $status) { ?>
            <option value="<?= $status['id_status'] ?>" <?= $status['id_status'] !== $product['id_status'] ?: 'selected' ?>><?= ucfirst($status['name']) ?></option>
         <?php } ?>
      </select>
   </p>
   <p><b>Quantity: </b><input type="number" name="quantity" value="<?= $product['quantity'] ?>" placeholder="Quantity"></p>
   <div><b>Prices: </b></div>
   <?php foreach ($prices as $idPrice => $price) { ?>
      <p>
         <select name="price[<?= intval($idPrice) ?>][status]">
            <?php foreach ($allPriceStatuses as $status) { ?>
               <option value="<?= $status['id_status'] ?>" <?= $status['id_status'] !== $prices[$idPrice]['id_status'] ?: 'selected' ?>><?= ucfirst($status['name']) ?></option>
            <?php } ?>
         </select>
         <input type="number" name="price[<?= intval($idPrice) ?>][price]" value="<?= $prices[$idPrice]['price'] ?? '' ?>" placeholder="Price">
         <label class="btn btn-warning"><input type="radio" name="active" value="<?= $idPrice ?>" <?= $price['active'] ? 'checked' : '' ?>> Choose</label>
         <button class="btn btn-danger" type="submit" name="deletePrice" value="<?= $idPrice ?>">Delete</button>
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
   <div>
      <?= $this->getImage([
         'name' => $product['main_image'],
         'alt' => $product['name'] . '_image',
         'class' => 'image',
         'id' => 'img' . $product['id_product'],
      ]); ?>
   </div>
   <p><input type="file" name="main_image" value="<?= $product['main_image'] ?>"></p>
   <button class="btn btn-primary" type="submit" name="update" value="<?= $product['id_product'] ?>">Update</button>
   <a class="btn btn-secondary" href="<?= $this->getBaseURL('products') ?>">Back</a>
</form>

<?php require 'app/resource/views/admin/components/footer.php'; ?>