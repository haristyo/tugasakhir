<div class="wrapper d-flex align-items-stretch">
	<nav id="sidebar" class="active">
		<div class="custom-menu">
			<button type="button" id="sidebarCollapse" class="btn btn-primary">
	          <i class="fa fa-bars"></i>
	          <span class="sr-only" >Toggle Menu</span>
	        </button>
        </div>
		<div class="px-4 pt-4">
			<h1><a href="<?=base_url('/proyek/'.$member['id_project'])?>" class="logo"><?=$member['nama_project'];?> <span><?=$member['position'];?></span></a></h1>
	        <ul class="list-unstyled components mb-5">
	          <li class=" <?php if ($link == "proyek/".$member['id_project']) {echo"active";} ?>">
	            <a href="<?=base_url('/proyek/'.$member['id_project'])?>"><span class="fa fa-info mr-4"></span>Detail</a>
	          </li>
	          <li class=" <?php if ($link == "proyek/".$member['id_project']."/board") {echo "active";} ?>">
	              <a href="<?=base_url('/proyek/'.$member['id_project'].'/board')?>"><span class="fa fa-clipboard mr-3"></span>Project Board</a>
	          </li>
			  <li class=" <?php if ($link == "proyek/".$member['id_project']."/resource") {echo "active";} ?>">
			  	<a href="<?=base_url('/proyek/'.$member['id_project'].'/resource')?>"><span class="fa fa-file mr-3"></span> Resource</a>
			  </li>
	          <li class=" <?php if ($link == "proyek/".$member['id_project']."/meeting") {echo "active";} ?>">
              	<a href="<?=base_url('/proyek/'.$member['id_project'].'/meeting')?>"><span class="fa fa-video-camera mr-3"></span>Meeting</a>
	          </li>
	          <li class=" <?php if ($link == "proyek/".$member['id_project']."/presensi") {echo "active";} ?>">
			  	<a href="<?=base_url('/proyek/'.$member['id_project'].'/presensi')?>"><span class="fa fa-calendar-check-o mr-3"></span>Presensi</a>
	          </li>
	          <li class="p-0 m-0" >
			  <form action="/proyek/deletemember/<?=$member['id_project'];?>/<?=$member['id_member'];?>/" method="post">
				<?= csrf_field();?>
				<button type="submit" class="btn btn-danger text-left pl-0  m-0 w-100">
					<span class="fa fa-sign-out mr-3"></span> Keluar Proyek
				</button>
			  </form>
	          </li>
	        </ul>


	        <div class="footer">
	        	<p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
				<div class="row  my-auto w-100">
					<div class="col-6 col-md-6 col-lg-6 col-sm-12 my-auto">
					
					<!-- <img src="https://dsitd.ipb.ac.id/wp-content/uploads/2017/04/Logo-IPB-baru.png" alt="Logo IPB" height="90px" style="display: block;margin-left: auto; margin-right: auto;"> -->
					<!-- <img src="<?php  //echo base_url('img/Logo-IPB-baru.png'); ?>" alt="Logo IPB" height="90px" style="display: block;margin-left: auto; margin-right: auto;"> -->
					<img src="<?php  echo base_url('img/Logo-IPB-baru.svg'); ?>" alt="Logo IPB" height="90px" style="display: block;margin-left: auto; margin-right: auto;">
					</div>
					<div class="col-6 col-md-6 col-lg-6 col-sm-12 my-auto">
					<!-- <img src="<?php //echo base_url('img/Logo-INF2.png')?>" alt="Logo INF" height="90px" style="display: block;margin-left: auto; margin-right: auto;"> -->
					<img src="<?php echo base_url('img/Logo-INF2.svg')?>" alt="Logo INF" height="90px" style="display: block;margin-left: auto; margin-right: auto;">
					<!-- <img src="https://o.remove.bg/downloads/2f8cabef-5b6a-4a0d-93d5-fe83eeb47c85/e3003bd36ebc05272061db2d627ddbb6_400x400-removebg-preview.png" alt="Logo INF" height="90px" style="display: block;margin-left: auto; margin-right: auto;"> -->
					</div>
				</div>
						  Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved</p>
	        </div>

		</div>
	</nav>

        <!-- Page Content  -->


