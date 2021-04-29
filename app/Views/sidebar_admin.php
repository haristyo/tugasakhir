<div class="wrapper d-flex align-items-stretch">
	<nav id="sidebar" class="active">
		<div class="custom-menu">
			<button type="button" id="sidebarCollapse" class="btn btn-primary">
	          <i class="fa fa-bars"></i>
	          <span class="sr-only">Toggle Menu</span>
	        </button>
        </div>
		<div class="p-4">
		<h1><a href="<?=base_url('/dashboard/')?>" class="logo"><?=$user['username'];?> <span><?php if( $user['is_admin']=="Y"){ echo "admin";} elseif ($user['is_admin']=="S") {echo "superadmin";}?></span></a></h1>
	        <ul class="list-unstyled components mb-5">
	          <li class=" <?php if ($link == "user") {echo "active";} ?>">
	              <a href="<?=base_url('/dashboard/user')?>"><span class="fa fa-user mr-3"></span>User</a>
	          </li>
	          <li class=" <?php if ($link == "proyek") {echo "active";} ?>">
	            <a href="<?=base_url('/dashboard/proyek')?>"><span class="fa fa-tasks mr-3"></span>Proyek</a>
	          </li>
			  <li class=" <?php if ($link == "member") {echo "active";} ?>">
			  <a href="<?=base_url('/dashboard/member')?>"><span class="fa fa-user"></span><span class="fa fa-user mr-1"></span> Member</a>
			  </li>
	          <li class=" <?php if ($link == "meeting") {echo "active";} ?>">
              <a href="<?=base_url('/dashboard/meeting')?>"><span class="fa fa-video-camera mr-3"></span>Meeting</a>
	          </li>
			  <?php if( $user['is_admin']=="S"){?>
	          <li class="p-0 m-0 <?php if ($link == "registerAdmin") {echo "active";} ?>">
			  <a href="<?=base_url('user/registerAdmin');?>"><span class="fa fa-user-plus mr-2"></span> Tambah Admin</a>
	          </li>
			  <?php ;}?>
	        </ul>


	        <div class="footer">
	        	<p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
						  Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved</p>
	        </div>

	      </div>
    	</nav>

        <!-- Page Content  -->


