<div class="wrapper d-flex align-items-stretch">
	<nav id="sidebar" >
		<div class="custom-menu">
			<button type="button" id="sidebarCollapse" class="btn btn-primary">
	          <i class="fa fa-bars"></i>
	          <span class="sr-only">Toggle Menu</span>
	        </button>
        </div>
		<div class="p-4">
			<h1><a href="index.html" class="logo"><?=$member['nama_project'];?> <span><?=$member['position'];?></span></a></h1>
	        <ul class="list-unstyled components mb-5">
	          <li class="active">
	            <a href="<?=base_url('/proyek/'.$member['id_project'])?>"><span class="fa fa-home mr-3"></span>Detail</a>
	          </li>
	          <li>
	              <a href="#"><span class="fa fa-user mr-3"></span>Project Board</a>
	          </li>
			  <li>
			  <a href="#"><span class="fa fa-suitcase mr-3"></span> Resource</a>
			  </li>
	          <li>
              <a href="<?=base_url('/proyek/'.$member['id_project'].'/meeting')?>"><span class="fa fa-briefcase mr-3"></span>Meeting</a>
	          </li>
	          <li>
              <a href="#"><span class="fa fa-sticky-note mr-3"></span>Presensi</a>
	          </li>
	          <li>
              <a href="#"><span class="fa fa-cogs mr-3"></span> Services</a>
	          </li>
	          <li>
              <a href="#"><span class="fa fa-paper-plane mr-3"></span> Contacts</a>
	          </li>
	        </ul>


	        <div class="footer">
	        	<p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
						  Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved</p>
	        </div>

	      </div>
    	</nav>

        <!-- Page Content  -->


