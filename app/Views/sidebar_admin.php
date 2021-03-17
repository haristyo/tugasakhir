<div class="wrapper d-flex align-items-stretch">
	<nav id="sidebar" >
		<div class="custom-menu">
			<button type="button" id="sidebarCollapse" class="btn btn-primary">
	          <i class="fa fa-bars"></i>
	          <span class="sr-only">Toggle Menu</span>
	        </button>
        </div>
		<div class="p-4">
			<h1><a href="<?=base_url('/dashboard/')?>" class="logo"><?=$user['username'];?> <span><?=$user['nama_user'];?></span></a></h1>
	        <ul class="list-unstyled components mb-5">
	          <li>
	              <a href="<?=base_url('/dashboard/user')?>"><span class="fa fa-user mr-3"></span>User</a>
	          </li>
	          <li>
	            <a href="<?=base_url('/dashboard/proyek')?>"><span class="fa fa-home mr-3"></span>Proyek</a>
	          </li>
			  <li>
			  <a href="<?=base_url('/dashboard/member')?>"><span class="fa fa-suitcase mr-3"></span> Member</a>
			  </li>
	          <li>
              <a href="<?=base_url('/dashboard/meeting')?>"><span class="fa fa-briefcase mr-3"></span>Meeting</a>
	          </li>
	          <li class="p-0 m-0">
			  <a href="<?=base_url('user/registerAdmin');?>"><span class="fa fa-paper-plane mr-3"></span> Tambah Admin</a>
	          </li>
	        </ul>


	        <div class="footer">
	        	<p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
						  Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved</p>
	        </div>

	      </div>
    	</nav>

        <!-- Page Content  -->


