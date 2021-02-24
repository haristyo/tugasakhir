<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <title><?= $title?></title>
  </head>
  <body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary d-flex">
  <a class="navbar-brand " href="<?=base_url()?>">Scrum Tool</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class=" collapse navbar-collapse" id="navbarNavDropdown">
    <ul class=" ml-auto mr-0 navbar-nav">
      <li class="nav-item <?php if ($link == "") {echo 'active';}?>">
        <a class="nav-link" href="<?=base_url()?>">Home </a>
      </li>
      <li class="nav-item <?php if ($link == "login") {echo 'active';}?>">
        <a class="nav-link" href="<?=base_url('/login')?>">Login</a>
      </li>
      <li class="nav-item <?php if ($link == "about-us") {echo 'active';}?>">
        <a class="nav-link" href="<?=base_url('/about-us');?>">About us </a>
      </li>
      <li class="nav-item dropdown d-none">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Dropdown link
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li>
    </ul>
  </div>
</nav>

