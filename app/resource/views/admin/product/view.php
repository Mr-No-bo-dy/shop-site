<?php require 'app/resource/views/admin/components/header.php'; ?>

<h4>Product</h4>

<figure>
   <figcaption>
      <div><?= $this->getImage([
               'name' => $product['main_image'],
               'alt' => $product['name'] . '_image',
               'class' => 'image',
               'id' => 'img' . $product['id_product'],
            ]); ?></div>
      <h5 class="my-3">Name: <strong><?= $product['name'] ?></strong></h5>
      <p><b>ID:</b> <?= $product['id_product'] ?></p>
      <p><b>Description:</b> <?= $product['description'] ?></p>
      <p><b>Category: </b><?= ucfirst($category) ?></p>
      <p><b>Status: </b><?= ucfirst($status) ?></p>
      <p><b>Quantity:</b> <?= $product['quantity'] ?></p>
      <div><b>Prices:</b></div>
      <?php foreach ($statuses as $status) { ?>
         <?php foreach ($prices as $price) { ?>
            <?php if ($status['id_status'] === $price['id_status']) { ?>
               <div><?= ucfirst($status['name']) ?>: <?= $price['price'] ?>$</div>
            <?php } ?>
         <?php } ?>
      <?php } ?>
   </figcaption>
</figure>

<a class="btn btn-secondary" href="<?= $this->getBaseURL('products') ?>">Back</a>

<?php require 'app/resource/views/admin/components/footer.php'; ?>