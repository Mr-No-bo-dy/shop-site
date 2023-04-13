<?php
   require ("app/resource/views/home/components/header.php");
   // require ("_temp/error_register.php");
?>

   <h2>Welcome to Shop, <?= $data['name'] ?></h2>
   <?//= '<pre>'; ?>
   <?php //var_dump($data['products']); ?>
   <?//= '</pre>'; ?>

   <h2>Our Products:</h2>
   <?php foreach($data['products'] as $product) {?>
   <h3><?= $product['name'] ?></h3>
   <p>Price: <b><?= $product['price'] ?> $</b></p>
   <?php } ?>

   <h2>Selled Products:</h2>
   <?php foreach($data['orders'] as $order) {?>
   <h3><?= $order['name'] ?></h3>
   <p>Price: <b><?= $order['total_price'] ?> $</b></p>
   <?php } ?>

   <h2>Our best sellers:</h2>
   <?php foreach($data['users'] as $user) {?>
   <h3><?= $user['first_name']?> <?= $user['last_name']?></h3>
   <p>Total Order: <b><?= $user['total_price'] ?> $</b></p>
   <?php } ?>

   <h2>Our best customers:</h2>
   <?php foreach($data['customers'] as $customer) {?>
   <h3><?= $customer['first_name']?> <?= $customer['last_name']?></h3>
   <p>Total Order: <b><?= $customer['total_price'] ?> $</b></p>
   <?php } ?>

<?php 
   require ("app/resource/views/home/components/footer.php"); 
?>