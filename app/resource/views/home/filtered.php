<?php require 'app/resource/views/home/components/header.php'; ?>

<div class="container-lg">
   <div>
      <form action="<?= $this->getBaseURL('../home') ?>" method="post">
         <button class="btn btn-secondary" type="submit" name="resetFilters" value="1">Reset Filters</button>
      </form>
   </div>
   
   <h1 class="h3">Filtered</h1>
   <div class="row">
      <?php foreach ($allProducts as $product) { ?>
         <div class="col-md-3">
            <figure class="p-3 card">
               <figcaption>
                  <div><?= $this->getImage([
                           'name' => $product['main_image'],
                           'alt' => $product['name'] . '_image',
                           'class' => 'image',
                           'id' => 'img' . $product['id_product'],
                        ]); ?></div>
                  <h2 class="my-3 h5"><strong><?= $product['name'] ?></strong></h2>
                  <p><b>Status: </b><?= ucfirst($product['status_name']) ?></p>
                  <p><b>Price: </b><?= $product['price'] ?> $</p>
                  <form action="" method="post">
                     <button class="btn btn-primary" type="submit" name="cart" value="<?= $product['id_product'] ?>">Add to Cart</button>
                  </form>
               </figcaption>
            </figure>
         </div>
      <?php } ?>
   </div>
</div>

<?php require 'app/resource/views/home/components/footer.php'; ?>