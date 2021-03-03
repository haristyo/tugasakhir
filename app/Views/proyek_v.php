<div class="container px-2 w-75 py-4 center"  style="background-color:#fbeeac; border-radius:10px; min-height:599px;">
    <h1 class="text-center"> Proyek Saya</h1>
    <hr width="75%" color="black" style="height:5px;">
    <div class=" d-flex w-75 mx-auto">
        <a href="<?= base_url('/proyek/join');?>" class="mr-0 ml-auto btn btn-primary">Bergabung</a>
        <a href="<?= base_url('/proyek/create');?>" class="mr-0 ml-2 btn btn-success">Buat Proyek</a>
    </div>
    <div class="row w-75 mx-auto">
        <?php  foreach ($proyek as $proyek) { ?>
            <div class="col-12 col-sm-12 col-md-6 col-lg-4 p-1" style="radius-border:50%;">
                <div class="card w-100 h-100" style="border-radius:5%;">
                    <div class="card-body w-100 h-100">
                    <h5 class="card-title" align="center"><?=$proyek['nama_project']; ?></h5>
                    <p class="card-text "><?php echo nl2br(substr($proyek['deskripsi'],0,75))."..."; ?></p>
                    
                    </div>
                    <a href="<?= base_url().'/proyek/'.$proyek['id_project'];?>" class=" w-75 mb-1 btn btn-success align-self-center" >Lihat Proyek</a>
                </div>
            </div>
            <?php } ?>    
   
    </div>
</div>