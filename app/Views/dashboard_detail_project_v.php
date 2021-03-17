<div id="content" class="p-4 p-md-5 pt-5">

<h1 class="text-center"> <?=$project['nama_project'];?></h1>
<hr width="75%" color="black" style="height:5px;">
<!-- <h2> -->
    <div class="d-flex w-75 ml-auto mr-auto">
    
        <div class="ml-0 mr-auto"><h5>Pembuat</h5></div>
        
        <div class="mr-0 ml-auto"><h5><?=$project['username'];?>(<?=$project['nama_user'];?>)</h5></div> 
    </div>
    <div class="d-flex w-75 ml-auto mr-auto">
    
        <div class="ml-0 mr-auto"><h5>Dibuat Tanggal</h5></div>
        
        <div class="mr-0 ml-auto"><h5><?=$project['created_project'];?></h5></div> 
    </div>
    <div class="d-flex w-75 ml-auto mr-auto">
    
        <div class="ml-0 mr-auto"><h5>Kode Gabung</h5></div>
        
        <div class="mr-0 ml-auto"><h5><?=$project['kode_join'];?></h5></div> 
    </div>
    <div class="d-flex w-75 ml-auto mr-auto">
    
        <div class="ml-0 mr-auto"><h5>Kata Sandi Project</h5></div>
        
        <div class="mr-0 ml-auto"><h5><?=$project['password_project'];?></h5></div> 
    </div>
    

    <hr width="75%" color="black" style="height:5px;">

        <h6 class="text-center"> <?=$project['deskripsi'];?></h6>

    
    <div class="row d-flex w-75 ml-auto mr-auto">
        <div class="col-4 ml-0 mr-auto w-100 h-100 p-0" >
        <a href="<?= base_url('/dashboard/member/'.$project['id_project']);?>" class=" btn btn-success py-4" style="width:90%;">
            <h5 class=" text-white py-4  text-center">Member</h5>
        </a>
        </div>
        <div class="col-4 ml-auto mr-auto w-100 h-100 p-0 d-flex" >
        <a href="<?= base_url('/dashboard/meeting/'.$project['id_project']);?>" class=" btn btn-info py-4 ml-auto mr-auto " style="width:90%;">
            <h5 class=" text-white py-4 text-center">Meeting</h5>
        </a>
        </div>
        <div class="col-4 ml-auto mr-0 w-100 h-100 p-0 d-flex" >
        <a href="<?= base_url('/dashboard/resource/'.$project['id_project']);?>" class=" btn btn-primary py-4 text-right ml-auto mr-0" style="width:90%;">
        <h5 class=" text-white py-4 text-center">Resource</h5>
        </a>
        </div>
        
    </div>


</div>
</div>