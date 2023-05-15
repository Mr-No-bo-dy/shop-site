<?php require 'app/resource/views/admin/components/header.php'; ?>

<h4>Product</h4>

<figure>
   <figcaption>
      <img src="<?//= $product['main_image'] ?>" alt="product_image">
      <h5 class="my-3">Name: <strong><?= $product['name'] ?></strong></h5>
      <p><b>ID:</b> <?= $product['id_product'] ?></p>
      <p><b>Description:</b> <?= $product['description'] ?></p>
      <p><b>Quantity:</b> <?= $product['quantity'] ?></p>
      <p><b>Prices:</b></p>
      <?php foreach ($statuses as $idS => $status) { ?>
         <?php foreach ($prices as $idP => $price) { ?>
            <?php if ($status['id_status'] === $price['id_status']) { ?>
               <p><?= ucfirst($status['name']) ?>: <?= $price['price'] ?></p>
            <?php } ?>
         <?php } ?>
      <?php } ?>
   </figcaption>
</figure>

<?php require 'app/resource/views/admin/components/footer.php'; ?>