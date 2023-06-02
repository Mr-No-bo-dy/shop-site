<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="/app/resource/css/styles.css">
	<!-- Using bootstrap.min.css v5.2.3 -->
	<link rel="stylesheet" href="/app/resource/css/bootstrap.min.css">
	<title></title>
</head>

<body>
	<header class="header d-flex justify-content-between mb-3 bg-light shadow">
      <div class="navbar"><a class="navbar-brand" href="/"><img src="logo.png" alt="Logo"></a></div>
		<nav class="navbar navbar-text">
			<ul class="nav">
				<li><a class="nav-link" href="/">Home</a></li>
				<li><a class="nav-link" href="#">Staff</a></li>
				<li><a class="nav-link" href="#">Categories</a></li>
				<li><a class="nav-link" href="/">Products</a></li>
				<?php if(!isset($_SESSION['user']['id_user'])) { ?>
					<li><a class="nav-link" href="<?//= $this->getBaseURL('register') ?>/admin/register">Register</a></li>
					<li><a class="nav-link" href="<?//= $this->getBaseURL('login') ?>/admin/login">Login</a></li>
				<?php } else { ?>
					<li><a class="nav-link" href="/admin">Admin</a></li>
					<li><a class="nav-link" href="logout">Logout</a></li>
				<?php } ?>
			</ul>
		</nav>
      <form class="d-flex">
         <input class="form-control me-2" type="search" placeholder="Search">
         <button class="btn btn-outline-primary" type="submit">Go</button>
      </form>
	</header>