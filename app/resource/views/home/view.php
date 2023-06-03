<?php require 'app/resource/views/home/components/header.php'; ?>

<div>
   <form action="<?//= $this->getBaseURL('home') ?>home" method="post">
      <button class="btn btn-secondary" type="submit" name="resetFilters" value="1">Back</button>
   </form>
</div>
<div><a class="btn btn-success" href="<?//= $this->getBaseURL('home/cart') ?>home/cart">Cart</a></div>

<div class="m-2">
   <h2>Filtered</h2>
   <div class="flex">
      <?php foreach ($products as $product) { ?>
         <figure class="figure">
            <figcaption>
               <div><?= $this->getImage([
                        'name' => $product['main_image'],
                        'alt' => $product['name'] . '_image',
                        'class' => 'image',
                        'id' => 'img' . $product['id_product'],
                     ]); ?></div>
               <h5 class="my-3">Name: <strong><?= $product['name'] ?></strong></h5>
               <p><b>Description:</b> <?= $product['description'] ?></p>
               <p><b>Category: </b><?= ucfirst($product['category_name']) ?></p>
               <p><b>Status: </b><?= ucfirst($product['status_name']) ?></p>
               <div><b>Prices:</b></div>
               <?php foreach ($product['prices'] as $prices) { ?>
                  <?php foreach ($prices as $status => $price) { ?>
                     <p class="m-0"><?= ucfirst($status) ?> <?= $price ?></p>
                  <?php } ?>
               <?php } ?>
               <form action="" method="post">
                  <button class="btn btn-primary" type="submit" name="cart" value="<?= $product['id_product'] ?>">В кошик</button>
               </form>
            </figcaption>
         </figure>
      <?php } ?>
   </div>
</div>

<?php require 'app/resource/views/home/components/footer.php'; ?>