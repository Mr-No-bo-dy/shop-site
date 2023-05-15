<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Using bootstrap.min.css v5.2.3 -->
	<link rel="stylesheet" href="/app/resource/css/bootstrap.min.css">
	<link rel="stylesheet" href="/app/resource/css/styles.css">
	<title></title>
</head>

<body>
   <header class="header">
      <nav class="navbar navbar-dark bg-dark fixed-top">
         <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar">
               <span class="navbar-toggler-icon"></span>
            </button>
            <div class="dropdown" aria-haspopup="true" >
               <a class="navbar-brand dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><?= $_SESSION['user']['login'] ?></a>
               <ul class="dropdown-menu dropdown-menu-end dropdown-menu-dark">
                  <li><a class="dropdown-item" href="#">Profile</a></li>
                  <li><hr class="dropdown-divider"></li>
                  <li><a class="dropdown-item" href="<?= $this->getBaseURL('logout') ?>">Logout</a></li>
               </ul>
            </div>
            <div class="offcanvas offcanvas-start text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
               <div class="offcanvas-header">
               <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">Dark offcanvas</h5>
               <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
               </div>
               <div class="offcanvas-body">
               <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                  <li class="nav-item">
                     <a class="nav-link active" aria-current="page" href="<?= $this->getBaseURL('../admin') ?>">Dashboard</a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" href="<?= $this->getBaseURL('status') ?>">Statuses</a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" href="<?= $this->getBaseURL('products') ?>">Products</a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" href="user">Users</a>
                  </li>
               </ul>
               <form class="d-flex mt-3" role="search">
                  <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                  <button class="btn btn-success" type="submit">Search</button>
               </form>
               </div>
            </div>
         </div>
      </nav>
   </header>
   <div class="wrapper ms-3 mb-3">