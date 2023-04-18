<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="app/resource/css/styles.css">
	<link rel="stylesheet" href="app/resource/css/header.css">
	<title></title>
</head>

<body>
	<header class="header">
		<div class="logo">
			<a href="home"><img src="logo.png" alt="Тут міг бути ваш Лого"></a>
		</div>
		<div class="nav">
			<ul>
				<li><a href="home">Home</a></li>
				<li class="dropdown">
					<a href="#">Products</a>
					<div class="dropdown-content">
						<!-- <a href="#">Product 1</a>
						<a href="#">Product 2</a>
						<a href="#">Product 3</a> -->
					</div>
				</li>
				<li class="dropdown">
					<a href="#">Services</a>
					<div class="dropdown-content">
						<!-- <a href="#">Service 1</a>
						<a href="#">Service 2</a>
						<a href="#">Service 3</a> -->
					</div>
				</li>
				<li><a href="#">About Us</a></li>
				<li><a href="#">Contact Us</a></li>
				<?php if(!isset($_SESSION['users']['admin'])) { ?>
					<li><a href="login">Login</a></li>
				<?php } else { ?>
					<li><a href="logout">Logout</a></li>
				<?php } ?>
			</ul>
		</div>
		<div class="search">
			<form>
				<input type="text" placeholder="Search...">
				<button type="submit">Go</button>
			</form>
		</div>
	</header>