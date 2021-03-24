<div class="wrapper d-flex align-items-stretch">
	<nav id="sidebar" >
		<div class="custom-menu">
			<button type="button" id="sidebarCollapse" class="btn btn-primary">
	          <i class="fa fa-bars"></i>
	          <span class="sr-only">Toggle Menu</span>
	        </button>
        </div>
		<div class="p-4">
			<h1><a href="<?=base_url('/proyek/'.$member['id_project'])?>" class="logo"><?=$member['nama_project'];?> <span><?=$member['position'];?></span></a></h1>
	        <ul class="list-unstyled components mb-5">
	          <li class=" <?php if ($link == "proyek/".$member['id_project']) {echo"active";} ?>">
	            <a href="<?=base_url('/proyek/'.$member['id_project'])?>"><span class="fa fa-info mr-4"></span>Detail</a>
	          </li>
	          <li class=" <?php if ($link == "proyek/".$member['id_project']."presensi") {echo "active";} ?>">
	              <a href="#"><span class="fa fa-clipboard mr-3"></span>Project Board</a>
	          </li>
			  <li class=" <?php if ($link == "proyek/".$member['id_project']."/resource") {echo "active";} ?>">
			  	<a href="#"><span class="fa fa-file mr-3"></span> Resource</a>
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
					<span class="fa fa-paper-plane mr-3"></span> Keluar Proyek
				</button>
			  </form>
	          </li>
	        </ul>


	        <div class="footer">
	        	<p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
						  Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved</p>
	        </div>

	      </div>
    	</nav>

        <!-- Page Content  -->


