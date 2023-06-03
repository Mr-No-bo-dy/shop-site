<?php require 'app/resource/views/home/components/header.php'; ?>

<h2>My Cart</h2>
   <?php foreach ($allProducts as $product) { ?>
      <figure class="figure">
         <figcaption>
            <div><?= $this->getImage([
                     'name' => $product['main_image'],
                     'alt' => $product['name'] . '_image',
                     'class' => 'image',
                     'id' => 'img' . $product['id_product'],
                  ]); ?></div>
            <h5 class="my-3">Name: <strong><?= $product['name'] ?></strong></h5>
            <p><b>ID: </b><?= $product['id_product'] ?></p>
            <p><b>Quantity: </b>
               <?php foreach ($productCounts as $idProduct => $countArray) { ?>
                  <?php if ($idProduct === $product['id_product']) { ?>
                     <?= $countArray['count'] ?>
                  <?php } ?>
               <?php } ?>
            </p>
            <p><b>Price: </b>
               <?php foreach ($prices as $idProduct => $price) { ?>
                  <?php if ($idProduct === $product['id_product']) { ?>
                     <?= $price ?>
                  <?php } ?>
               <?php } ?>
            </p>
            <p><b>Total Price: </b>
               <?php foreach ($totalPrices as $idProduct => $totalPrice) { ?>
                  <?php if ($idProduct === $product['id_product']) { ?>
                     <?= $totalPrice ?>
                  <?php } ?>
               <?php } ?>
            </p>
            <form action="" method="post">
               <button class="btn btn-primary" type="submit" name="remove_cart" value="<?= $product['id_product'] ?>">Видалити з кошика</button>
            </form>
         </figcaption>
      </figure>
   <?php } ?>

<?php require 'app/resource/views/home/components/footer.php'; ?>