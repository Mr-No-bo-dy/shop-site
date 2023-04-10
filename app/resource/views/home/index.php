<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Index</title>
	<!-- <link rel="stylesheet" href="header.css"> -->
   <!-- <link rel="stylesheet" href="../../css/header.css"> -->
   <link rel="stylesheet" href="../../../resource/css/header.css">
</head>
<body>

<?php
   // require ("components/header.php");
   // require ("_temp/error_login.php");
?>
   <header class="header">
		<div class="logo">
			<img src="logo.png" alt="Logo">
		</div>
		<div class="nav">
			<ul>
				<li><a href="#">Home</a></li>
				<li class="dropdown">
					<a href="#">Products</a>
					<div class="dropdown-content">
						<a href="#">Product 1</a>
						<a href="#">Product 2</a>
						<a href="#">Product 3</a>
					</div>
				</li>
				<li class="dropdown">
					<a href="#">Services</a>
					<div class="dropdown-content">
						<a href="#">Service 1</a>
						<a href="#">Service 2</a>
						<a href="#">Service 3</a>
					</div>
				</li>
				<li><a href="#">About Us</a></li>
				<li><a href="#">Contact Us</a></li>
			</ul>
		</div>
		<div class="search">
			<form>
				<input type="text" placeholder="Search...">
				<button type="submit">Go</button>
			</form>
		</div>
	</header>

   <h2>Welcome to Shop, <?= $data['name'] ?></h2>
   <?= '<pre>'; ?>
   <?php //var_dump($data['products']); ?>
   <?php //var_dump($product) ?>
   <?= '</pre>'; ?>
   
   <h2>Our Products:</h2>
   <?php foreach($data['products'] as $product) {?>
      <h3><?= $product['name'] ?></h3>
      <p>Price: <b><?= $product['price'] ?> $</b></p>
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

</body>
</html>

<?php 
   //require ("components/footer.php"); 
?>