<!doctype html>
<html lang="id">
  <head>
  <link href="<?= base_url('logo.png');?>" rel="icon">
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> -->
    <script src="<?= base_url('js/jquery-3.6.0.min.js');  ?>" type='text/javascript' ></script>
    <script src="<?= base_url('js/bootstrap.bundle.js');  ?>" type='text/javascript' ></script>

    <script>var base_url = '<?= base_url(); ?>'; </script>
  
    <script src="<?php echo base_url('Chart.js');?>"></script>
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?= base_url('css/bootstrap.css')?>">
    <link rel="stylesheet" href="<?= base_url('css/style1.css')?>">
		<!-- font -->

		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    

    <title><?= $title?></title>
  </head>
  <!-- <body class="h-100 w-100" style="background-color:lightblue;" oncontextmenu="return false" onkeydown="return false" onmousedown="return false"> -->
  <body class="h-100 w-100" style="background-color:lightblue;" >
  <nav class="navbar navbar-expand-lg navbar-dark d-flex px-4 py-2" style="background-color:#3445b4;">
  <img src="<?=base_url('logo.png')?>" id="sidebarCollapse2"  width="32" height="32" class="p-1 mr-2" style="background-color:white;border-radius:10%;" alt="" >
    
  <a class="navbar-brand mr-2 ml-0 " href="<?=base_url()?>">Scrum Tool</a>

  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class=" collapse navbar-collapse" id="navbarNavDropdown">
    <ul class=" ml-auto navbar-nav">
      <li class="nav-item mx-2">
        <a class="nav-link btn btn-warning text-white" href="<?=base_url()?>" >Beranda</a>
      </li>
      <li class="nav-item  mx-2">
        <a class="nav-link btn btn-warning text-white" href="<?=base_url('/about');?>" >Tentang</a>
      </li>
      <?php if(session()->get('logged_in')==FALSE) {?>
      <li class="nav-item mx-2">
        <a class="nav-link btn btn-success text-white" href="<?=base_url('/login')?>" >Masuk</a>
      </li>
      <?php } else { ?>
      <li class="nav-item dropdown mx-2">
        <a class="nav-link dropdown-toggle btn btn-success text-white" style="border-radius:4px; mr-4" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <img src="<?= base_url('/img/profil/'.session()->get('profil'))?>" class="img-fluid" style="object-fit: contain;border-radius:50%; max-height:20px;" alt=<?= session()->get('profil')?>">
          <?php echo session()->get('username')."&nbsp;"."&nbsp;";?>
        </a>   
        <div class="dropdown-menu" style="margin-left:20px;" aria-labelledby="navbarDropdownMenuLink">
        <?php if (session()->get('is_admin')=='N') {?>
          <a class="dropdown-item" href="<?= base_url('/proyek');?>">Proyek Saya</a>
          <a class="dropdown-item" href="<?= base_url('/profil');?>">Profil</a>
        <?php ;} else {?>
          <a class="dropdown-item" href="<?= base_url('/dashboard');?>">Dasbor</a>
          <a class="dropdown-item" href="<?= base_url('/profil');?>">Profil</a>
        <?php ;}?>

          <div class="dropdown-divider"></div>
          <a class=" dropdown-item w-100 mr-4" style="color: white; background-color:red;"  href="<?= base_url('/logout');?>">Keluar</a>
        </div>
        
      </li>
      <?php }?>
    </ul>
  </div>
</nav>

