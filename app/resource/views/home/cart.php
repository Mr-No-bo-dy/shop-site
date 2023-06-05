<?php require 'app/resource/views/home/components/header.php'; ?>

<div class="container-lg">
   <h2>My Cart</h2>
   <div class="row">
      <?php foreach ($cartProducts as $product) { ?>
         <div class="col-md-3">
            <figure class="p-3 card">
               <figcaption>
                  <div><?= $this->getImage([
                           'name' => $product['main_image'],
                           'alt' => $product['name'] . '_image',
                           'class' => 'image',
                           'id' => 'img' . $product['id_product'],
                        ]); ?></div>
                  <h5 class="my-3"><strong><?= $product['name'] ?></strong></h5>
                  <p><b>ID: </b><?= $product['id_product'] ?></p>
                  <p><b>Quantity: </b><?= $product['count'] ?></p>
                  <p><b>Price: </b><?= $product['price'] ?> $</p>
                  <p><b>Total Price: </b><?= $product['totalPrice'] ?> $</p>
                  <form action="" method="post">
                     <button class="btn btn-warning" type="submit" name="remove_cart" value="<?= $product['id_product'] ?>">Remove from Cart</button>
                  </form>
               </figcaption>
            </figure>
         </div>
      <?php } ?>
   </div>
</div>

<?php require 'app/resource/views/home/components/footer.php'; ?>