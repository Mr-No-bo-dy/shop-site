<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="/app/resource/css/styles.css">
	<!-- Using bootstrap.min.css v5.2.3 -->
	<link rel="stylesheet" href="/app/resource/css/bootstrap.min.css">
	<title>Techno Shop - <?= $title ?? '' ?></title>
</head>

<body>
	<header class="header d-flex justify-content-between mb-3 bg-light shadow">
      <div class="navbar p-2"><a class="navbar-brand" href="<?= $this->getBaseURL('../home') ?>"><img style="max-height: 30px;" src="/app/resource/img/php-logo.png" alt="Logo"></a></div>
		<nav class="navbar navbar-text">
			<ul class="nav">
				<li><a class="nav-link" href="<?= $this->getBaseURL('../home') ?>">Home</a></li>
				<li><a class="nav-link" href="#">Staff</a></li>
				<li><a class="nav-link" href="#">Categories</a></li>
				<li><a class="nav-link" href="<?= $this->getBaseURL('../home') ?>">Products</a></li>
				<li><a class="nav-link" href="<?= $this->getBaseURL('../home/cart') ?>">Cart</a></li>
				<?php if(!isset($_SESSION['user']['id_user']) && !isset($_SESSION['customer']['id_customer'])) { ?>
					<li><a class="nav-link" href="<?= $this->getBaseURL('../home/register') ?>">Register</a></li>
					<li><a class="nav-link" href="<?= $this->getBaseURL('../home/login') ?>">Login</a></li>
				<?php } elseif (isset($_SESSION['user']['id_user'])) { ?>
					<li><a class="nav-link" href="<?= $this->getBaseURL('../admin') ?>">Admin</a></li>
					<li><a class="nav-link" href="<?= $this->getBaseURL('logout') ?>">Logout</a></li>
				<?php } else { ?>
					<li><a class="nav-link" href="<?= $this->getBaseURL('logout') ?>">Logout</a></li>
				<?php } ?>
			</ul>
		</nav>
      <form class="p-2 d-flex" action="<?= $this->getBaseURL('../home') ?>" method="post">
			<input class="form-control me-2" type="search" name="productName" value="<?= $_POST['productName'] ?? '' ?>" placeholder="Search">
         <button class="btn btn-outline-primary" type="submit">Go</button>
      </form>
	</header>