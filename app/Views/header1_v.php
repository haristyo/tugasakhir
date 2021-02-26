<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet"
2
      href="https://use.fontawesome.com/releases/v5.1.0/css/all.css"
3
      integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt"
4
      crossorigin="anonymous">

    <title><?= $title?></title>
  </head>
  <body class="h-100 w-100" style="background-color:lightblue;">
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary d-flex px-4">
  <a class="navbar-brand " href="<?=base_url()?>">Scrum Tool</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class=" collapse navbar-collapse" id="navbarNavDropdown">
    <ul class=" ml-auto mr-0 navbar-nav">
      <li class="nav-item <?php if ($link == "") {echo 'active';}?>">
        <a class="nav-link btn" href="<?=base_url()?>">Home </a>
      </li>
      <li class="nav-item  <?php if ($link == "about-us") {echo 'active';}?>">
        <a class="nav-link btn " href="<?=base_url('/about-us');?>">About us </a>
      </li>
      <?php if(session()->get('id_user')==FALSE) {?>
      <li class="nav-item mx-1<?php if ($link == "login") {echo 'active';}?>">
        <a class="nav-link btn btn-success" href="<?=base_url('/login')?>">Login</a>
      </li>
      <?php } else { ?>
      <li class="nav-item dropdown d-none">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <?php echo session()->get('username');?>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="<?= base_url('/project');?>">My Project</a>
          <a class="dropdown-item" href="<?= base_url('/profil');?>">Profil</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="<?= base_url('/logout');?>">Logout</a>
        </div>
        
      </li>
      <?php }?>
    </ul>
  </div>
</nav>

