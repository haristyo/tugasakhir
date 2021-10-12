<div id="content" class="mr-0 pr-0 ml-2 pl-2 pt-4" style="width:99%; height:99%">
<?php //dd($member['position']); ?>
                        <?php if ($ishavescrummaster == null) { ?>
                            <div class="mx-auto w-75 section-title text-center">
                                <div class=" alert alert-danger" role="alert">
                                <i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Anda tidak memiliki Scrum master, hubungi <a href="mailto:scrum.tool55@gmail.com">scrum.tool55@gmail.com</a> untuk mengganti Scrum master baru
                                </div>  
                            </div>
                        <?php }?>
                        <?php if ($incomingmeeting != null) {?>
                            <div class="section-title text-center">
                                <div class=" w-75 mt-2 mx-auto alert alert-warning" role="alert">
                                <i class="fa fa-clock-o" aria-hidden="true"></i> Anda memiliki meeting hari ini pada <?php echo date('H:i:s',strtotime($incomingmeeting['time_meeting'])); ?>
                                </div>  
                            </div>
                        <?php }?>

    <div class="ml-auto mr-auto pt-4" style="overflow-y:auto; display: flex; height : 100vh; width:95%; background-color:#fbeeac">
        <div class="p-0 mt-0" style="background-color:#dcf5ef; width : 25%; height:96vh; ">
            <!-- Button trigger modal -->
                <div class="d-flex" style="background-color:#fbeeac;">
                <?php if ($member['position'] !="Development Team") {?>
                    <h6 class="text-center pb-2 pl-4 mr-0 ml-auto" >Product Notes</h6>
                    
                    <span class="fa fa-plus py-1 mr-2 ml-auto" data-toggle="modal" data-target="#createnotes" style="z-index:2;"></span>
                <?php ;} else { ?>
                    <h6 class="text-center pb-2 mx-auto" >Product Notes</h6>
                <?php ;} ?>
                </div>
                <!-- end Button trigger modal -->
                <!-- Modal -->
                <div class="modal fade" id="createnotes" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" >
                <div class="modal-content" style="background-color:#fbeeac;">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Tambah Product Notes</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form class="" method="post" action="/proyek/createNotes">
                        <div class="modal-body">
                                <?= csrf_field(); ?>
                                <input type="hidden" class="form-control" name="id_project" value="<?=$member['id_project']?>" >
                                <div class="form-group">
                                    <label for="#isinotes" style="float: left; color:black;">Isi</label>
                                    <textarea class="w-100 <?php if ($validation->hasError('isinotes')) {echo 'is-invalid';} ?>" id="isinotes" name="isinotes"></textarea>
                                    <!-- <small id="emailHelp" class="form-text text-muted">enter your email or username</small> -->
                                    <div class="invalid-feedback">
                                        <?=$validation->getError('isinotes');?>
                                        <?=session()->getFlashData('isinotes');?>
                                    </div>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">Tambah Notes</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        </div>
                        </form>
                    </div>

                </div>
                </div>
            <!-- end modal-->
                        <?php if ($validation->hasError('isinotes')) {echo "<script> $('#createnotes').modal('show'); </script>"; } ?>
                        
                     

                <div style=" overflow-y:auto; height:25%; max-height:40%; min-height:25%; background-color:" class="mb-1 mt-2 mx-1">
                    <?php foreach ($note as $notes) {
                        
                        if ($notes['sprint'] == null) {?>
                            <!-- Button trigger modal -->
                            <div class=" d-flex w-100 mx-auto" >
                            <button type="button" class="p-0 m-1 w-100" data-toggle="modal" data-target="#notes<?=$notes['id_notes'];?>">
                                <div class='mx-auto text-white'  style='background-color:grey;'><?=$notes['isi'];?></div>
                            </button>
                            </div>
                            <!-- end Button trigger modal -->
                            <!-- Modal -->
                            <div class="modal fade" id="notes<?=$notes['id_notes'];?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content" style="background-color:#dcf5ef;">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Product Notes</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form class="" method="post" action="/proyek/editnotes/<?=$notes['id_notes'] ;?>">
                                    <div class="modal-body">
                                            <?= csrf_field(); ?>
                                            <div class="form-group">
                                                <textarea class="w-100 <?php if ($validation->hasError('isinotesedit'.$notes['id_notes'])) {echo 'is-invalid';} ?>" id="isinotesedit<?=$notes['id_notes'];?>" name="isinotesedit<?=$notes['id_notes'];?>" rows="6"><?=$notes['isi'];?></textarea>
                                                <!-- <small id="emailHelp" class="form-text text-muted">enter your email or username</small> -->
                                                <div class="invalid-feedback">
                                                    <?=$validation->getError('isinotesedit'.$notes['id_notes']);?>
                                                </div>
                                            </div>
                                    </div>
                                        <div class="modal-footer">
                                            <?php if($notes['editor_notes']==null){?>
                                                <p class="ml-0 mr-auto" style="color:black;">Dibuat oleh <?= $notes['nama_pembuat'];?></p>
                                            <?php } else{?>
                                                <p class="ml-0 mr-auto" style="color:black;">Diubah oleh <?= $notes['nama_pengedit'];?></p>
                                            <?php } ?> 
                                            <button type="submit" class="btn btn-danger" value="delete" name="submit">Hapus Notes</button>
                                            <button type="submit" class="btn btn-success" value="edit" name="submit">Ubah Notes</button>
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                        </form>
                                    </div>
                                </div>

                            </div>
                            </div>
                        <!-- end modal-->
                        <?php 
                        if ($validation->hasError('isinotesedit'.$notes['id_notes'])) { 
                            echo "<script> $('#notes".$notes['id_notes']."').modal('show'); </script>";
                            ;} ?>
                        
                       <?php }
                    }?>
                </div>


            <!-- Button trigger modal -->
                <div class="d-flex" style="background-color:#fbeeac;">
                <?php $total=0; foreach ($countbacklog as $countbacklogs) {
                        if ($countbacklogs['sprint'] == null ) {
                            $total  =$countbacklogs['point'];
                            // echo ($counts['id_sprint']);
                        }
                    }
                    echo ("<h6 class='pl-2 mt-2'>".$total.'</h6>');
                ?>
                <?php if ($member['position'] !="Development Team") {?>
                    <h6 class="text-center pb-2 pl-4 mt-2 mr-0 ml-auto" >Product Backlog</h6>
                    <span class="fa fa-plus mt-2 py-1 mr-2 ml-auto" data-toggle="modal" data-target="#createbacklog" style="z-index:2;"></span>
    
                <?php ;} else { ?>
                    
                    <h6 class="text-center pb-2 mt-2 mx-auto" >Product Backlog</h6>
                <?php ;} ?>
                </div>
                <!-- end Button trigger modal -->
                <!-- Modal -->
                <div class="modal fade" id="createbacklog" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" >
                <div class="modal-content" style="background-color:#fbeeac;">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Tambah Product Backlog</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form class="" method="post" action="/proyek/createbacklog">
                        <div class="modal-body">
                                <?= csrf_field(); ?>
                                <input type="hidden" class="form-control" name="id_project" value="<?=$member['id_project']?>" >
                                <div class="form-group">
                                    <label for="#isi" style="float: left; color:black;">Isi</label>
                                    <textarea class="w-100 <?php if ($validation->hasError('isibacklog')) {echo 'is-invalid';} ?>" id="isibacklog" name="isibacklog"></textarea>
                                    <!-- <small id="emailHelp" class="form-text text-muted">enter your email or username</small> -->
                                    <div class="invalid-feedback">
                                        <?=$validation->getError('isibacklog');?>
                                        <?=session()->getFlashData('isibacklog');?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="#point" style="float: left; color:black;">Storypoint</label>
                                    <input type="number" class="form-control" name="point" <?php if ($validation->hasError('isibacklog')) {?> value="<?=old('point')?>" <?php ;}?>>
                                    <small class="form-text text-muted"> Tingkat Kesulitan </small>
                                    <!-- <small id="emailHelp" class="form-text text-muted">enter your email or username</small> -->
                                </div>
                        </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success">Tambah Backlog</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            </form>
                        </div>
                    </div>

                </div>
                </div>
            <!-- end modal-->
                        <?php if ($validation->hasError('isibacklog')) {echo "<script> $('#createbacklog').modal('show'); </script>"; } ?>
                        
                     

                <div style="flex-grow: 1; flex-basis: 100%; overflow-y:auto; min-height:50%; height:58%; background-color:" id="backlog-product" class="mb-1 mt-2 mx-1" <?php if ($member['position'] =="Scrum Master") {?> ondrop="onDropBacklog(event);"  ondragover="onDragOverBacklog(event);" <?php ;}?> >
                    <?php foreach ($backlog as $backlogs) {
                        if ($backlogs['sprint'] == null) {?>
                            <!-- Button trigger modal -->
                            <div class=" d-flex w-100 mx-auto" <?php if ($member['position'] =="Scrum Master") {?> draggable="true" id="item-<?=$backlogs['id_backlog']?>" ondragstart="onDragStart(event);" <?php ;}?>>
                            <button type="button" class="p-0 m-1 w-100" data-toggle="modal" data-target="#backlog<?=$backlogs['id_backlog'];?>">
                                <div class='pl-1 mr-auto text-white text-left my-0'  style='background-color:grey;'><?=$backlogs['point'] ;?></div>
                                <div class='mx-auto text-white'  style='background-color:grey;'><?=$backlogs['isi'] ;?></div>
                            </button>
                            </div>
                            <!-- end Button trigger modal -->
                            <!-- Modal -->
                            <div class="modal fade" id="backlog<?=$backlogs['id_backlog'];?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content" style="background-color:#dcf5ef;">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Product Backlog</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form class="" method="post" action="/proyek/editbacklog/<?=$backlogs['id_backlog'] ;?>">
                                    <div class="modal-body">
                                            <?= csrf_field(); ?>
                                            <div class="form-group">
                                                <label for="posisi" class="text-left" style="float: left; color:black;">To</label>
                                                <select class="custom-select" name="posisi">
                                                    <option value="Product Backlog" selected >Product Backlog</option>
                                                    <?php if ($lastsprint['id_sprint']!=null) {?>
                                                        <option value="Sprint Backlog" >Sprint Backlog</option>
                                                    <?php };?>
                                                </select>
                                            </div>
                                    
                                            <div class="form-group">
                                                <label for="isibacklog<?=$backlogs['id_backlog'];?>" style="float: left; color:black;">Isi</label>
                                                <textarea class="w-100 <?php if ($validation->hasError('isibacklog'.$backlogs['id_backlog'])) {echo 'is-invalid';} ?>" id="isibacklog<?=$backlogs['id_backlog'];?>" name="isibacklog<?=$backlogs['id_backlog'];?>" rows="2"><?=$backlogs['isi'];?></textarea>
                                                <!-- <small id="emailHelp" class="form-text text-muted">enter your email or username</small> -->
                                                <div class="invalid-feedback">
                                                    <?=$validation->getError('isibacklog'.$backlogs['id_backlog']);?>
                                                    <?=session()->getFlashData('isibacklog'.$backlogs['id_backlog']);?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="point" style="float: left; color:black;">Storypoint</label>
                                                <input type="number" class="form-control" name="point" value="<?=$backlogs['point'];?>">
                                                <small class="form-text text-muted"> Tingkat Kesulitan </small>
                                                <!-- <small id="emailHelp" class="form-text text-muted">enter your email or username</small> -->
                                            </div>
                                    </div>
                                        <div class="modal-footer">
                                            <?php if($backlogs['editor_backlog']==null){?>
                                                <p class="ml-0 mr-auto" style="color:black;">Dibuat oleh <?= $backlogs['nama_pembuat'];?></p>
                                            <?php } else{?>
                                                <p class="ml-0 mr-auto" style="color:black;">Diubah oleh <?= $backlogs['nama_pengedit'];?></p>
			                                <?php } ?> 
                                            <?php if ($member['position'] !="Development Team") {?>
                                                <button type="submit" class="btn btn-danger" value="delete" name="submit">Hapus Backlog</button>
	                                   	        <button type="submit" class="btn btn-success" value="edit" name="submit">Ubah Backlog</button>
                                            <?php } ?>
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                        </form>
                                    </div>
                                </div>

                            </div>
                            </div>
                        <!-- end modal-->
                        <?php 
                        if ($validation->hasError('isibacklog'.$backlogs['id_backlog'])) { 
                            echo "<script> $('#backlog".$backlogs['id_backlog']."').modal('show'); </script>";
                            ;} ?>
                        
                       <?php }
                    }?>
                </div>
        </div>
        


<!-- sprint -->
        <div class="p-0 m-0" style="background-color:#fbeeac;  height:100vh; max-height:90%; width : 75%;  ">
            <div class="d-flex">
            <?php if ($member['position'] =="Scrum Master") {?>
                <h6 class="ml-auto">Sprint</h6>
                <a class="fa fa-plus py-1 mr-2 ml-auto" <?php if($lastsprint==null) {?> href="/proyek/createsprint/<?=$member['id_project']?>"<?php ;}elseif ($lastsprint['end_sprint']!=null ) {
                    ?> href="/proyek/createsprint/<?=$member['id_project']?>"<?php ;
                } else { ?> data-target="#ongoing" data-toggle="modal" <?php ;}?> style="color:grey"></a>
    
                <?php ;} else { ?>
                    
                    <h6 class="mx-auto">Sprint</h6>
                <?php ;} ?>
                
                
                <!-- Modal -->
                <div class="modal fade" id="ongoing" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Anda Masih memiliki sprint yang masih berjalan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Akhiri Sprint yang masih berjalan terlebih dahulu sebelum memulai sprint baru
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    </div>
                    </div>
                </div>
                </div>
                <!-- End Modal -->

            </div>
            <div style="overflow-y:auto;  height:92vh">
            <?php $ke=$totalsprint['id_sprint']+1; foreach ($sprint as $sprints) {?>
                <div class=" p-0 mx-0" style="  width : 100%;"> 
                <div class="d-flex" style="background-color:#3445b4;">  
                    <h7 class="px-2 mr-auto text-white btn-success"> <?= $sprints['start_sprint'];?> </h7>
                    <h6 class="mx-auto text-white" >Sprint <?=--$ke?> </h6>
                    <?php if($sprints['end_sprint']!=null) {?>
                        <h7 class="px-2 ml-auto" style="color: #fff;background-color: #dc3545;border-color: #dc3545;">  <?=$sprints['end_sprint']?> </h7>
                        <?php } else { ?>
                            <h7 class="px-4 ml-auto text-white btn-danger" data-target="#konfirmasistop" data-toggle="modal" style='color:white;font-family:poppins;'>
                                <span class='fa fa-check'></span> Stop Sprint</a>
                            </h7>
                            

                            <!-- Modal -->
                            <div class="modal fade" id="konfirmasistop" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Stop Sprint</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <h5>
                                            Apakah anda yakin menghentikan sprint ?
                                        </h5>
                                        <h7>
                                        Setelah dihentikan sprint tidak bisa diubah kembali
                                        </h7>
                                    </div>
                                    <div class="modal-footer">
                                        <form action="/proyek/endsprint/<?=$sprints['id_sprint'];?>">
                                        <?= csrf_field(); ?>
                                        <?php if($member['position'] =="Scrum Master") {?>
                                            <button type="submit" class="btn btn-danger">Stop Sprint</button>
                                        <?php }?>
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            </div>
                        <?php }?>
                </div>
                    <div class="m-0 p-0" style="background-color:#ffffff; overflow-x:scroll; height : 88vh;  ">
                        <div style="width : 2700px; display: flex;background-color:#c5efe5;">
                            <div class=" p-0 text-white text-center " style=" width: 450px; height:20vh">

                                <div style=" height: 100%; width:97%;" class="mx-auto mt-1" >
                                    
                                    <div class="d-flex pb-0" style="background-color:#111111;">
                                    <?php if(($sprints['end_sprint'] == null || $sprints['end_sprint'] > date('Y-m-d H:i:s', time())) && ($member['position'] !="Product Owner")) {?>
                                    <div class="text-center  pl-4 mr-0 ml-auto" >Sprint Notes</div>
                                    <span class="fa fa-plus py-1 mr-2 ml-auto" data-toggle="modal" data-target="#createnotes<?=$sprints['id_sprint'];?>"></span>
                                    <?php } else {?>
                                    <div class="text-center  pl-4 mx-auto" >Sprint Notes</div>
                                    <?php }?>
                                </div>
                                <?php if($sprints['end_sprint'] == null || $sprints['end_sprint'] > date('Y-m-d H:i:s', time())) {?>
                                            
                                <!-- Modal -->
                                    <div class="modal fade" id="createnotes<?=$sprints['id_sprint'];?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-lg" >
                                    <div class="modal-content" style="background-color:#c5efe5;">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Tambah Sprint Notes</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form class="" method="post" action="/proyek/createnotes/<?=$sprints['id_sprint'];?>">
                                            <div class="modal-body">
                                                <?= csrf_field(); ?>
                                                <input type="hidden" name="id_project" value="<?=$member['id_project'];?>">
                                                <div class="form-group" >
                                                    <textarea class="w-100 <?php if ($validation->hasError('isinotes'.$sprints['id_sprint'])) {echo 'is-invalid';} ?>" rows="6" id="isinotes<?=$sprints['id_sprint'];?>" name="isinotes<?=$sprints['id_sprint'];?>" ><?= old('isi')?></textarea>
                                                    <div class="invalid-feedback text-left">
                                                        <?=$validation->getError('isinotes'.$sprints['id_sprint']);?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                            
                                                <button type="submit" class="btn btn-success">Tambah Notes</button>
                                            
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                            </div>
                                            </form>
                                    </div>
                                    </div>
                                    </div>
                                <!-- end modal-->
                                <?php 
                                    if ($validation->hasError('isinotes'.$sprints['id_sprint'])) { 
                                        echo "<script> $('#createnotes".$sprints['id_sprint']."').modal('show'); </script>";
                                ;} ?>
        
                                <?php }?>

                                    <div style="background-color:#c5efe5; height: 16vh; overflow:auto;" class="mb-1 py-1">

                                    <?php foreach ($note as $notes){
                                        if ($notes['sprint']==$sprints['id_sprint']) {?>
                                        <!-- Button trigger modal -->
                                            <div class=" d-flex w-100 mx-auto">
                                            <button type="button" class="p-0 m-1 w-100" data-toggle="modal" data-target="#editnotes<?=$notes['id_notes'];?>">
                                                <div class='mx-auto text-white'  style='background-color:grey;'><?=$notes['isi'] ;?></div>
                                            </button>
                                            </div>
                                            <!-- end Button trigger modal -->
                                            <!-- Modal -->
                                            <div class="modal fade" id="editnotes<?=$notes['id_notes'];?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                            <div class="modal-content" style="background-color:#dcf5ef;">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Sprint Notes</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form class="" method="post" action="/proyek/editnotes/<?=$notes['id_notes'] ;?>">
                                                    <div class="modal-body">
                                                            <?= csrf_field(); ?>
                                                            <div class="form-group">
                                                                <textarea class="w-100 <?php if ($validation->hasError('isinotesedit'.$notes['id_notes'])) {echo 'is-invalid';} ?>" id="isinotesedit<?=$notes['id_notes'];?>" name="isinotesedit<?=$notes['id_notes'];?>" rows="6"><?=$notes['isi'];?></textarea>
                                                                <!-- <small id="emailHelp" class="form-text text-muted">enter your email or username</small> -->
                                                                <div class="invalid-feedback">
                                                                    <?=$validation->getError('isinotesedit'.$notes['id_notes']);?>
                                                                    <?=session()->getFlashData('isinotesedit'.$notes['id_notes']);?>
                                                                </div>
                                                            </div>
                                                    </div>
                                                        <div class="modal-footer">
                                                        <?php if($notes['editor_notes']==null){?>
                                                            <p class="ml-0 mr-auto" style="color:black;">Dibuat oleh <?= $notes['nama_pembuat'];?></p>
                                                        <?php } else{?>
                                                            <p class="ml-0 mr-auto" style="color:black;">Diubah oleh <?= $notes['nama_pengedit'];?></p>
                                                        <?php } ?> 
                                                        <?php if(($sprints['end_sprint'] == null || $sprints['end_sprint'] > date('Y-m-d H:i:s', time())) && ($member['position'] !="Product Owner")) {?>
                                                            <button type="submit" class="btn btn-danger" value="delete" name="submit">Hapus Notes</button>
                                                            <button type="submit" class="btn btn-success" value="edit" name="submit">Ubah Notes</button>
                                                        <?php }?>
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                                        </form>
                                                    </div>
                                                </div>

                                            </div>
                                            </div>
                                        <!-- end modal-->
                                        <?php 
                                        if ($validation->hasError('isinotesedit'.$notes['id_notes'])) { 
                                            echo "<script> $('#editnotes".$notes['id_notes']."').modal('show'); </script>";
                                            ;} ?>
                                        <?php }
                                    }
                                    ?>
                                     
                                    </div>

                                </div>
                                <div style="background-color:#111111; width:97%;" class="mx-auto mt-1" >
                                    Sprint Goal
                                    <div style="background-color:#c5efe5; height: 10vh; overflow:auto;" class="mb-1 py-1">

                                    <!-- Button trigger modal -->
                                        <div class=" d-flex w-100 mx-auto">
                                            <button type="button" class="p-0 m-1 w-100 h-100" data-toggle="modal" data-target="#sprint<?=$sprints['id_sprint'];?>">

                                                
                                                    <?php 
                                                    if($sprints['goal'] == null) {
                                                        echo "<div class='mx-auto '  style='height:50px; background-color:grey; color:black;'><i>isi sprint goal...</i>";
                                                    }
                                                    else {
                                                        echo "<div class='mx-auto text-white'  style='height:50px;background-color:grey;'>".$sprints['goal'];
                                                    }
                                                    ?>
                                                                </div>
                                            </button>
                                        </div>
                                    <!-- end Button trigger modal -->
                                    <!-- Modal -->
                                        <div class="modal fade" id="sprint<?=$sprints['id_sprint'];?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-lg">
                                        <div class="modal-content" style="background-color:#c5efe5;">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Sprint Goal <?=$ke?></h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form class="" method="post" action="/proyek/editgoal/<?=$sprints['id_sprint'] ;?>">
                                                <div class="modal-body">
                                                        <?= csrf_field(); ?>
                                                
                                                        <div class="form-group">
                                                            <label for="goal<?=$sprints['id_sprint'];?>" style="float: left; color:black;">Isi</label>
                                                            <textarea class="w-100" id="goal<?=$sprints['id_sprint'];?>" name="goal<?=$sprints['id_sprint'];?>" rows="3"><?=$sprints['goal'];?></textarea>
                                                            <!-- <small id="emailHelp" class="form-text text-muted">enter your email or username</small> -->
                                                        </div>
                                                </div>
                                                    <div class="modal-footer">
                                                    <?php if(($sprints['end_sprint'] == null || $sprints['end_sprint'] > date('Y-m-d H:i:s', time()))&&($member['position'] =="Scrum Master")) {?>
                                                        <button type="submit" class="btn btn-success">Ubah Sprint Goal</button>
                                            <?php }?>
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                                    </form>
                                                </div>
                                        </div>
                                        </div>
                                        </div>
                                    <!-- end modal-->
                                     
                                    </div>

                                </div>

                                <div style="background-color:#111111; width:97%;" class="mx-auto mb-1">
                                    <div class="d-flex">
                                        <?php $total = 0; foreach ($countbacklog as $countbacklogs) {
                                                if ($countbacklogs['sprint'] == $sprints['id_sprint'] ) {
                                                    $total  =$countbacklogs['point'];
                                                    // echo ($counts['id_sprint']);
                                                }
                                            }
                                            echo ("<div class='my-auto pl-2'>".$total.'</div>');
                                        ?>
                                        <div class="my-auto mx-auto text-center">Sprint Backlog</div>
                                    </div>
                                    <div style="background-color:#c5efe5; overflow-y:auto; height: 45vh; flex-grow: 1; flex-basis: 100%;" class="mb-auto py-1"  <?php if($sprints['end_sprint'] == null || $sprints['end_sprint'] > date('Y-m-d H:i:s', time())) {?> id="backlog-<?=$sprints['id_sprint'];?>"  <?php if ($member['position'] =="Scrum Master") {?> ondragover="onDragOverBacklog(event);" ondrop="onDropBacklog(event);"<?php }} ?>>
                                    <?php foreach ($backlog as $backlogs){
                                        if ($backlogs['sprint']==$sprints['id_sprint']) {?>
                                        <!-- Button trigger modal -->
                                            <div class=" d-flex w-100 mx-auto" <?php if(($sprints['end_sprint'] == null || $sprints['end_sprint'] > date('Y-m-d H:i:s', time())) && ($member['position'] =="Scrum Master"))  {?> draggable="true" id="item-<?=$backlogs['id_backlog']?>"  ondragstart="onDragStart(event);" <?php } ?>> 
                                            <button type="button" class="p-0 m-1 w-100" data-toggle="modal" data-target="#backlog<?=$backlogs['id_backlog'];?>">

                                                <div class='pl-2 mr-auto text-white text-left my-0'  style='background-color:grey;'><?=$backlogs['point'] ;?></div>
                                                <div class='mx-auto text-white'  style='background-color:grey;'><?=$backlogs['isi'] ;?></div>
                                            </button>
                                            </div>
                                            <!-- end Button trigger modal -->
                                            <!-- Modal -->
                                            <div class="modal fade" id="backlog<?=$backlogs['id_backlog'];?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                            <div class="modal-content" style="background-color:#dcf5ef;">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Sprint Backlog</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form class="" method="post" action="/proyek/editbacklog/<?=$backlogs['id_backlog'] ;?>">
                                                    <div class="modal-body">
                                                            <?= csrf_field(); ?>
                                                            <div class="form-group">
                                                                <label for="posisi" class="text-left" style="float: left; color:black;">To</label>
                                                                <select class="custom-select" name="posisi">
                                                                    <option value="Product Backlog"  >Product Backlog</option>
                                                                    <option value="Sprint Backlog" selected >Sprint Backlog</option>
                                                                </select>
                                                            </div>
                                                    
                                                            <div class="form-group">
                                                                <label for="isibacklog<?=$backlogs['id_backlog'];?>" style="float: left; color:black;">Isi</label>
                                                                <textarea class="w-100 <?php if ($validation->hasError('isibacklog'.$backlogs['id_backlog'])) {echo 'is-invalid';} ?>" id="isibacklog<?=$backlogs['id_backlog'];?>" name="isibacklog<?=$backlogs['id_backlog'];?>" rows="2"><?=$backlogs['isi'];?></textarea>
                                                                <!-- <small id="emailHelp" class="form-text text-muted">enter your email or username</small> -->
                                                                <div class="invalid-feedback">
                                                                    <?=$validation->getError('isibacklog'.$backlogs['id_backlog']);?>
                                                                    <?=session()->getFlashData('isibacklog'.$backlogs['id_backlog']);?>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="point" style="float: left; color:black;">Storypoint</label>
                                                                <input type="number" class="form-control" name="point" value="<?=$backlogs['point'];?>">
                                                                <small class=" ml-0 form-text text-muted" style="float:left;"> Tingkat Kesulitan </small>
                                                                <!-- <small id="emailHelp" class="form-text text-muted">enter your email or username</small> -->
                                                            </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <?php if($backlogs['editor_backlog']==null){?>
                                                            <p class="ml-0 mr-auto" style="color:black;">Dibuat oleh <?= $backlogs['nama_pembuat'];?></p>
                                                        <?php } else{?>
                                                            <p class="ml-0 mr-auto" style="color:black;">Diubah oleh <?= $backlogs['nama_pengedit'];?></p>
                                                        <?php } ?>

                                                        <?php if(($sprints['end_sprint'] == null || $sprints['end_sprint'] > date('Y-m-d H:i:s', time())) && ($member['position'] =="Scrum Master")) {?>
                                                            <button type="submit" class="btn btn-danger" value="delete" name="submit">Hapus Backlog</button>
                                                            <button type="submit" class="btn btn-success" value="edit" name="submit">Ubah Backlog</button>
                                                        <?php }?>
                                                    </form>
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                                    </div>
                                            </div>

                                            </div>
                                            </div>
                                        <!-- end modal-->
                                        <?php 
                                        if ($validation->hasError('isibacklog'.$backlogs['id_backlog'])) { 
                                            echo "<script> $('#backlog".$backlogs['id_backlog']."').modal('show'); </script>";
                                            ;} ?>
                                        <?php }
                                    }
                                    ?>
                                    </div>
                                </div>
                            </div>

                            
                            <div class="px-1 pt-1 pb-1 text-white text-center m-0" style="background-color:#8be0cc; width: 450px; height:100%;">
                            <div style="background-color:#111111;"></div>
                            <!-- Button trigger modal -->
                                <div class="d-flex pb-0" style="background-color:#111111;">
                                    
                                    <?php if($sprints['end_sprint'] == null || $sprints['end_sprint'] > date('Y-m-d H:i:s', time())) {?>
                                            <div class="text-center  ml-2 mr-auto" >
                                                <?php $elapsed = 0; $estimated = 0;
                                                foreach ($count as $counts) {
                                                        if ($counts['id_sprint'] == $sprints['id_sprint'] && $counts['status'] == "TO DO" ) {
                                                        
                                                            $elapsed = $counts['elapsed'];
                                                            $estimated = $counts['estimated'];
                                                            // echo ($counts['id_sprint']);
                                                        }
                                                    }
                                                    echo ($elapsed.'/'.$estimated );
                                                ?>
                                            </div>
                                                <?php if ($member['position'] !="Product Owner") {?>
                                                    <div class="text-center mx-auto" >To Do</div>
                                                                    <span class="fa fa-plus py-1 mr-2 ml-auto" data-toggle="modal" data-target="#createepic" style="z-index:2;"></span>
                                    
                                                <?php ;} else { ?>
                                                    
                                                    <div class="text-center mx-auto" >To Do</div>
                                                <?php ;} ?>
                                    
                                    <?php } else {?>
                                        <div class="text-center ml-2 mr-auto" >
                                            <?php $elapsed = 0; $estimated = 0;
                                            foreach ($count as $counts) {
                                                if ($counts['id_sprint'] == $sprints['id_sprint'] && $counts['status'] == "TO DO" ) {
                                                    $elapsed = $counts['elapsed'];
                                                    $estimated = $counts['estimated'];
                                                }
                                            
                                            }
                                            echo ($elapsed.'/'.$estimated );
                                            ?>
                                        </div>
                                    <div class="ml-0 pl-0 pr-4 mr-auto" >To Do</div>
                                    <?php }?>
                                    
                                </div>
                                <!-- end Button trigger modal -->
                                <?php if(($sprints['end_sprint'] == null || $sprints['end_sprint'] > date('Y-m-d H:i:s', time())) && ($member['position'] !="Product Owner")) {?>
                                <!-- Modal -->
                                <div class="modal fade" id="createepic" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg" >
                                <div class="modal-content" style="background-color:#fbeeac;">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Tambah Task</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form class="" method="post" action="/proyek/createepic">
                                        <div class="modal-body">
                                            <?= csrf_field(); ?>
                                            <input type="hidden" class="form-control" name="id_sprint" value="<?=$sprints['id_sprint']?>" >
                                            <div class="form-group form-row">
                                                <label for="estimated" class="col-2 text-left" style="float: left; color:black;">Estimasi </label>
                                                <input type="number" class="form-control col-10" name="estimated" value="<?= old('estimated')?>">
                                                <small class="form-text text-muted">Estimasi waktu pengerjaan dalam satuan jam</small>
                                            </div>
                                            <div class="form-row" >
                                                <label for="isiepic" class="col-2 text-left" style="float: left; color:black;">Isi</label>
                                                <textarea class="w-100 col-10 <?php if ($validation->hasError('isiepic')) {echo 'is-invalid';} ?>" rows="2" id="isiepic" name="isiepic" ><?= old('isiepic')?></textarea>
                                                <div class="col-2"></div>
                                                <div class="col-10 invalid-feedback text-left">
                                                    <?=$validation->getError('isiepic');?>
                                                </div>
                                            </div>
                                        </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-success">Tambah Task</button>
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                            </form>
                                        </div>
                                    </div>

                                </div>
                                </div>
                            <!-- end modal-->
                            <?php 
                                        if ($validation->hasError('isiepic')) { 
                                            echo "<script> $('#createepic').modal('show'); </script>";
                                            ;} ?>
                            <?php }?>

                                <div style="background-color:; overflow-y:auto; height:79vh;flex-grow: 1; flex-basis: 100%;" class="mb-1 py-1" <?php if(($sprints['end_sprint'] == null || $sprints['end_sprint'] > date('Y-m-d H:i:s', time())) && ($member['position'] !="Product Owner")) {?> id="TO DO-<?=$sprints['id_sprint'];?>"  ondragover="onDragOverEpic(event);" ondrop="onDropEpic(event);" <?php }?>>
                                    <?php foreach ($epic as $epics){
                                        if ($epics['status']=="TO DO" && $epics['id_sprint']==$sprints['id_sprint'] ) {?>
                                        
                                        <!-- Button trigger modal -->
                                        <div class=" d-flex w-100 mx-auto" <?php if(($sprints['end_sprint'] == null || $sprints['end_sprint'] > date('Y-m-d H:i:s', time())) && ($member['position'] !="Product Owner")) {?> ondragstart="onDragStart(event);" id="epic-<?=$epics['id_epic']?>" draggable="true" <?php }?>>
                                            <button type="button" class="p-0 m-1 w-100" data-toggle="modal" data-target="#epic<?=$epics['id_epic'] ;?>">
                                            <?php 
                                                $semua = 1; $checked = 0;
                                                foreach ($checkboxall as $checkboxalls) {
                                                    if ($checkboxalls['id_epic']==$epics['id_epic']) {
                                                        $semua = $checkboxalls['id_checkbox'];
                                                    }
                                                }
                                                
                                                foreach ($checkboxchecked as $checkboxcheckeds) {
                                                    if ($checkboxcheckeds['id_epic']==$epics['id_epic']) {
                                                        $checked = $checkboxcheckeds['id_checkbox'];
                                                    }
                                                }
                                                // d($checked);
                                                // dd($semua);

                                                ?>
                                                <div class="d-flex" style='background-color:grey;'>
                                                    <div class=' mr-auto ml-0 text-white my-0'  ><?php if($epics['elapsed']==null) {echo 0;} else{ echo $epics['elapsed'];} echo ('/'.$epics['estimated']) ;?></div>
                                                    <div class=' ml-auto mr-0 text-white my-0' ><?php echo (number_format($checked/$semua*100).'%');?></div>
                                                </div>
                                                <div class='mx-auto text-white'  style='background-color:grey;'><?=$epics['isi'] ;?></div>
                                            </button>
                                            </div>
                                            <!-- end Button trigger modal -->
                                            <!-- Modal -->
                                            <div class="modal fade " data-backdrop="static" id="epic<?=$epics['id_epic'];?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style=" overflow-y:auto;">
                                            <div class="modal-dialog modal-dialog-centered modal-lg ">
                                            <div class="modal-content" style="background-color:#8be0cc;">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Task</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" data-target="#epic<?=$epics['id_epic'] ;?>">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form class="" method="post" action="/proyek/editepic/<?=$epics['id_epic'] ;?>">
                                                    <div class="modal-body">
                                                            <?= csrf_field(); ?>
                                                            <input type="hidden" class="form-control" name="id_sprint" value="<?=$sprints['id_sprint'];?>">
                                                            <div class="form-group">
                                                                <label for="status<?=$epics['id_epic']?>" class="text-left" style="float: left; color:black;">To</label>
                                                                <select class="custom-select" name="status<?=$epics['id_epic']?>">
                                                                    <option value="TO DO"  selected>TO DO</option>
                                                                    <option value="ON PROGRESS">ON PROGRESS</option>
                                                                    <option value="VERIFY">VERIFY</option>
                                                                    <option value="DONE">DONE</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-row">
                                                                <div class="form-group col">
                                                                    <label for="Elapsed<?=$epics['id_epic'];?>" style="float: left; color:black;">Dihabiskan</label>
                                                                    <input type="number" class="form-control" name="elapsed<?=$epics['id_epic'];?>" value="<?=$epics['elapsed'];?>">
                                                                    <small class="form-text text-muted text-left"  style="float: left;">Waktu yang digunakan dalam satuan jam</small>
                                                                </div>
                                                                <div class="form-group col">
                                                                    <label for="estimated<?=$epics['id_epic'];?>" style="float: left; color:black;">Estimasi</label>
                                                                    <input type="number" class="form-control" name="estimated<?=$epics['id_epic'];?>" value="<?=$epics['estimated'];?>">
                                                                    <small class="form-text text-muted"  style="float: left;">Estimasi waktu pengerjaan dalam satuan jam</small>
                                                                </div>
                                                            </div>
                                                    
                                                            <div class="form-group">
                                                                <label for="isiepic<?=$epics['id_epic']?>" style="float: left; color:black;">Isi</label>
                                                                <textarea class="w-100 <?php if ($validation->hasError('isiepic'.$epics['id_epic'])) {echo 'is-invalid';} ?>" id="isiepic<?=$epics['id_epic'];?>" name="isiepic<?=$epics['id_epic'];?>" rows="2"><?=$epics['isi'];?></textarea>
                                                                <!-- <small id="emailHelp" class="form-text text-muted">enter your email or username</small> -->
                                                                <div class="invalid-feedback text-left">
                                                                    <?=$validation->getError('isiepic'.$epics['id_epic']);?>
                                                                </div>
                                                            </div>
                                                            <div class="ml-0 mr-auto d-flex" style="color:black;"><h4 class="my-auto">Checkbox</h4><?php if(($sprints['end_sprint'] == null || $sprints['end_sprint'] > date('Y-m-d H:i:s', time())) && ($member['position'] !="Product Owner")) {?> <i class="fa fa-plus-circle fa-2x mx-1 my-auto" style="color:blue;" data-toggle="modal" data-target="#createcheckbox<?=$epics['id_epic']?>"></i> <?php }?></div>
                                                            <?php foreach ($checkbox as $checkboxes) {
                                                                if ($checkboxes['id_epic']==$epics['id_epic']) {?>
                                                                     <div class="input-group mb-3">
                                                                        <div class="input-group-prepend">
                                                                            <div class="input-group-text">
                                                                            <input type="checkbox" name="checkbox[]" value="<?=$checkboxes['id_checkbox'];?>" <?php if($checkboxes['value']=='1') {echo "checked";}?> >
                                                                            </div>
                                                                        </div>
                                                                        <input type="text" class="form-control" aria-label="Text input with checkbox" value="<?=$checkboxes['isi'];?>" disabled>
                                                                        
                                                                        <a href="<?=base_url('proyek/deleteCheckbox/'.$checkboxes['id_checkbox'])?>" class="fa fa-minus-circle fa-2x my-auto  mx-1" style="color:red;"></a>
                                                                        

                                                                    </div>
                                                            <?php    }
                                                            }?>
                                                           
                                                        </div>
                                                        <div class="modal-footer">
                                                        <?php if($epics['editor_epic']==null){?>
                                                            <p class="ml-0 mr-auto" style="color:black;">Dibuat oleh <?= $epics['nama_pembuat'];?></p>
                                                        <?php } else{?>
                                                            <p class="ml-0 mr-auto" style="color:black;">Diubah oleh <?= $epics['nama_pengedit'];?></p>
                                                        <?php } ?> 
                                                        <?php if(($sprints['end_sprint'] == null || $sprints['end_sprint'] > date('Y-m-d H:i:s', time())) && ($member['position'] !="Product Owner")) {?>
                                                            <button type="submit" class="btn btn-danger" value="delete" name="submit">Hapus Task</button>
                                                            <button type="submit" class="btn btn-success" value="edit" name="submit">Ubah Task</button>
                                            <?php }?>
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal" >Tutup</button>
                                                        </form>
                                                    </div>
                                                </div>

                                            </div>
                                            </div>
                                            <div class="modal fade" id="createcheckbox<?=$epics['id_epic']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                            <div class="modal-dialog modal-dialog-centered modal-lg" >
                                                                            <div class="modal-content" style="background-color:#fbeeac;">
                                                                                    <div class="modal-header">
                                                                                        <h5 class="modal-title" id="exampleModalLabel">Tambah Checkbox</h5>
                                                                                        <button type="button" class="close" data-dismiss="modal" data-target="#createcheckbox<?=$epics['id_epic']?>" aria-label="Close">
                                                                                        <span aria-hidden="true">&times;</span>
                                                                                        </button>
                                                                                    </div>
                                                                                    <form class="" method="post" action="/proyek/createCheckbox/<?=$epics['id_epic']?>">
                                                                                    <div class="modal-body">
                                                                                            <?= csrf_field(); ?>
                                                                                            <div class="form-group">
                                                                                                <label for="#isicheckbox<?=$epics['id_epic']?>" style="float: left; color:black;">Isi</label>
                                                                                                <input type="text" class="form-control <?php if ($validation->hasError('isicheckbox'.$epics['id_epic'])) {echo 'is-invalid';} ?>" name="isicheckbox<?=$epics['id_epic']?>" value="">
                                                                                                <!-- <small id="emailHelp" class="form-text text-muted">enter your email or username</small> -->
                                                                                                <div class="invalid-feedback">
                                                                                                    <?=$validation->getError('isicheckbox'.$epics['id_epic']);?>
                                                                                                </div>
                                                                                            </div>
                                                                                    </div>
                                                                                    <div class="modal-footer">
                                                                                        <button type="submit" class="btn btn-success">Tambah Checkbox</button>
                                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal" >Tutup</button>
                                                                                    </div>
                                                                                    </form>
                                                                                </div>

                                                                            </div>
                                                                            </div>
                                        <!-- end modal-->


                                        <?php 
                                        if ($validation->hasError('isiepic'.$epics['id_epic'])||session()->getFlashdata('epic')==$epics['id_epic'] ) { 
                                            echo "<script> $('#epic".$epics['id_epic']."').modal('show'); </script>";
                                           
                                            ;} 
                                        elseif ($validation->hasError('isicheckbox'.$epics['id_epic'])) {
                                            echo "<script> $('#epic".$epics['id_epic']."').modal('show'); </script>";
                                            echo "<script> $('#createcheckbox".$epics['id_epic']."').modal('show'); </script>";
                                        }?>
                                        <?php
                                        }
                                    }
                                    ?>
                                </div>

                            </div>
                            <div class="px-1 pt-1 pb-1 text-white text-center m-0" style="background-color:#51d0b2; width: 450px; height:100%;">
                            
                            <div style="background-color:#111111;" class="d-flex"> 
                                <div class="text-center  ml-2 mr-auto" >
                                    <?php $elapsed = 0; $estimated = 0;
                                    foreach ($count as $counts) {
                                            if ($counts['id_sprint'] == $sprints['id_sprint'] && $counts['status'] == "ON PROGRESS" ) {
                                                $elapsed = $counts['elapsed'];
                                                $estimated = $counts['estimated'];
                                            }
                                        }
                                        echo ($elapsed.'/'.$estimated );
                                    ?>
                                </div>
                                <div class="pr-4 ml-0 mr-auto">On Progress</div>
                                
                            </div>
                                <div style="background-color:#51d0b2; overflow-y:auto; height:79vh;flex-grow: 1; flex-basis: 100%;" class="mb-1 py-1" <?php if(($sprints['end_sprint'] == null || $sprints['end_sprint'] > date('Y-m-d H:i:s', time())) && ($member['position'] !="Product Owner")) {?> id="ON PROGRESS-<?=$sprints['id_sprint'];?>"  ondragover="onDragOverEpic(event);" ondrop="onDropEpic(event);" <?php }?>>
                                <?php foreach ($epic as $epics){
                                        if ($epics['status']=="ON PROGRESS" && $epics['id_sprint']==$sprints['id_sprint'] ) {?>
                                        
                                        <!-- Button trigger modal -->
                                        <div class=" d-flex w-100 mx-auto"  <?php if(($sprints['end_sprint'] == null || $sprints['end_sprint'] > date('Y-m-d H:i:s', time())) && ($member['position'] !="Product Owner")) {?> ondragstart="onDragStart(event);" id="epic-<?=$epics['id_epic']?>" draggable="true" <?php }?>>
                                            <button type="button" class="p-0 m-1 w-100" data-toggle="modal" data-target="#epic<?=$epics['id_epic'] ;?>">
                                            <?php 
                                                 $semua = 1; $checked = 0;
                                                foreach ($checkboxall as $checkboxalls) {
                                                    if ($checkboxalls['id_epic']==$epics['id_epic']) {
                                                        $semua = $checkboxalls['id_checkbox'];
                                                    }
                                                }
                                                
                                                foreach ($checkboxchecked as $checkboxcheckeds) {
                                                    if ($checkboxcheckeds['id_epic']==$epics['id_epic']) {
                                                        $checked = $checkboxcheckeds['id_checkbox'];
                                                    }
                                                }
                                                // d($checked);
                                                // dd($semua);

                                                ?>
                                                <div class="d-flex" style='background-color:grey;'>
                                                    <div class=' mr-auto ml-0 text-white my-0'  ><?php if($epics['elapsed']==null) {echo 0;} else{ echo $epics['elapsed'];} echo ('/'.$epics['estimated']) ;?></div>
                                                    <div class=' ml-auto mr-0 text-white my-0' ><?php echo (number_format($checked/$semua*100).'%');?></div>
                                                </div>
                                                <div class='mx-auto text-white'  style='background-color:grey;'><?=$epics['isi'] ;?></div>
                                            </button>
                                            </div>
                                            <!-- end Button trigger modal -->
                                            <!-- Modal -->
                                            <div class="modal fade" id="epic<?=$epics['id_epic'];?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style=" overflow-y:auto;">
                                            <div class="modal-dialog modal-dialog-centered modal-lg ">
                                            <div class="modal-content" style="background-color:#51d0b2;">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Task</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form class="" method="post" action="/proyek/editepic/<?=$epics['id_epic'] ;?>">
                                                    <div class="modal-body">
                                                            <?= csrf_field(); ?>
                                                            <input type="hidden" class="form-control" name="id_sprint" value="<?=$sprints['id_sprint'];?>">
                                                            <div class="form-group">
                                                                <label for="status<?=$epics['id_epic']?>" class="text-left" style="float: left; color:black;">To</label>
                                                                <select class="custom-select" name="status<?=$epics['id_epic']?>">
                                                                    <option value="TO DO" >TO DO</option>
                                                                    <option value="ON PROGRESS" selected>ON PROGRESS</option>
                                                                    <option value="VERIFY">VERIFY</option>
                                                                    <option value="DONE">DONE</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-row">
                                                                <div class="form-group col">
                                                                    <label for="Elapsed<?=$epics['id_epic'];?>" style="float: left; color:black;">Dihabiskan</label>
                                                                    <input type="number" class="form-control" name="elapsed<?=$epics['id_epic'];?>" value="<?=$epics['elapsed'];?>">
                                                                    <small class="form-text text-muted" style="float: left;">Waktu yang digunakan dalam satuan jam</small>
                                                                </div>
                                                                <div class="form-group col">
                                                                    <label for="estimated<?=$epics['id_epic'];?>" style="float: left; color:black;">Estimasi</label>
                                                                    <input type="number" class="form-control" name="estimated<?=$epics['id_epic'];?>" value="<?=$epics['estimated'];?>">
                                                                    <small class="form-text text-muted" style="float: left;">Estimasi waktu pengerjaan dalam satuan jam</small>
                                                                </div>
                                                            </div>
                                                    
                                                            <div class="form-group">
                                                                <label for="isiepic<?=$epics['id_epic']?>" style="float: left; color:black;">Isi</label>
                                                                <textarea class="w-100 <?php if ($validation->hasError('isiepic'.$epics['id_epic'])) {echo 'is-invalid';} ?>" id="isiepic<?=$epics['id_epic'];?>" name="isiepic<?=$epics['id_epic'];?>" rows="2"><?=$epics['isi'];?></textarea>
                                                                <!-- <small id="emailHelp" class="form-text text-muted">enter your email or username</small> -->
                                                                <div class="invalid-feedback text-left">
                                                                    <?=$validation->getError('isiepic'.$epics['id_epic']);?>
                                                                </div>
                                                            </div>
                                                            <div class="ml-0 mr-auto d-flex" style="color:black;"><h4 class="my-auto">Checkbox</h4><?php if(($sprints['end_sprint'] == null || $sprints['end_sprint'] > date('Y-m-d H:i:s', time())) && ($member['position'] !="Product Owner")) {?> <i class="fa fa-plus-circle fa-2x mx-1 my-auto" style="color:blue;" data-toggle="modal" data-target="#createcheckbox<?=$epics['id_epic']?>"></i> <?php }?></div>
                                                            <?php foreach ($checkbox as $checkboxes) {
                                                                if ($checkboxes['id_epic']==$epics['id_epic']) {?>
                                                                     <div class="input-group mb-3">
                                                                        <div class="input-group-prepend">
                                                                            <div class="input-group-text">
                                                                            <input type="checkbox" name="checkbox[]" value="<?=$checkboxes['id_checkbox'];?>" <?php if($checkboxes['value']=='1') {echo "checked";}?> >
                                                                            </div>
                                                                        </div>
                                                                        <input type="text" class="form-control" aria-label="Text input with checkbox" value="<?=$checkboxes['isi'];?>" disabled>
                                                                        
                                                                        <a href="<?=base_url('proyek/deleteCheckbox/'.$checkboxes['id_checkbox'])?>" class="fa fa-minus-circle fa-2x my-auto  mx-1" style="color:red;"></a>
                                                                        

                                                                    </div>
                                                            <?php    }
                                                            }?>
                                                        </div>
                                                        <div class="modal-footer">
                                                        <?php if($epics['editor_epic']==null){?>
                                                            <p class="ml-0 mr-auto" style="color:black;">Dibuat oleh <?= $epics['nama_pembuat'];?></p>
                                                        <?php } else{?>
                                                            <p class="ml-0 mr-auto" style="color:black;">Diubah oleh <?= $epics['nama_pengedit'];?></p>
                                                        <?php } ?> 
                                                        <?php if(($sprints['end_sprint'] == null || $sprints['end_sprint'] > date('Y-m-d H:i:s', time())) && ($member['position'] !="Product Owner")) {?>
                                                            <button type="submit" class="btn btn-danger" value="delete" name="submit">Hapus Task</button>
                                                            <button type="submit" class="btn btn-success" value="edit" name="submit">Ubah Task</button>
                                            <?php }?>
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                                        </form>
                                                    </div>
                                                </div>

                                            </div>
                                            </div>
                                            <div class="modal fade" id="createcheckbox<?=$epics['id_epic']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                            <div class="modal-dialog modal-dialog-centered modal-lg" >
                                                                            <div class="modal-content" style="background-color:#fbeeac;">
                                                                                    <div class="modal-header">
                                                                                        <h5 class="modal-title" id="exampleModalLabel">Tambah Checkbox</h5>
                                                                                        <button type="button" class="close" data-dismiss="modal" data-target="#createcheckbox<?=$epics['id_epic']?>" aria-label="Close">
                                                                                        <span aria-hidden="true">&times;</span>
                                                                                        </button>
                                                                                    </div>
                                                                                    <form class="" method="post" action="/proyek/createCheckbox/<?=$epics['id_epic']?>">
                                                                                    <div class="modal-body">
                                                                                            <?= csrf_field(); ?>
                                                                                            <div class="form-group">
                                                                                                <label for="#isicheckbox<?=$epics['id_epic']?>" style="float: left; color:black;">Isi</label>
                                                                                                <input type="text" class="form-control <?php if ($validation->hasError('isicheckbox'.$epics['id_epic'])) {echo 'is-invalid';} ?>" name="isicheckbox<?=$epics['id_epic']?>" value="">
                                                                                                <!-- <small id="emailHelp" class="form-text text-muted">enter your email or username</small> -->
                                                                                                <div class="invalid-feedback">
                                                                                                    <?=$validation->getError('isicheckbox'.$epics['id_epic']);?>
                                                                                                </div>
                                                                                            </div>
                                                                                    </div>
                                                                                    <div class="modal-footer">
                                                                                        <button type="submit" class="btn btn-success">Tambah Checkbox</button>
                                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal" >Tutup</button>
                                                                                    </div>
                                                                                    </form>
                                                                                </div>

                                                                            </div>
                                                                            </div>
                                        <!-- end modal-->


                                        <?php 
                                        if ($validation->hasError('isiepic'.$epics['id_epic'])||session()->getFlashdata('epic')==$epics['id_epic'] ) { 
                                            echo "<script> $('#epic".$epics['id_epic']."').modal('show'); </script>";
                                           
                                            ;} 
                                        elseif ($validation->hasError('isicheckbox'.$epics['id_epic'])) {
                                            echo "<script> $('#epic".$epics['id_epic']."').modal('show'); </script>";
                                            echo "<script> $('#createcheckbox".$epics['id_epic']."').modal('show'); </script>";
                                        }?>
                                        <?php
                                        }
                                    }
                                    ?>
                                </div>

                            </div>
                            <div class="px-1 pt-1 pb-1 text-white text-center m-0" style="background-color:#2ea98c; width: 450px; height:100%;">
                            <div style="background-color:#111111;" class="d-flex"> 
                                <div class="text-center  ml-2 mr-auto" >
                                    <?php $elapsed = 0; $estimated = 0;
                                    foreach ($count as $counts) {
                                            if ($counts['id_sprint'] == $sprints['id_sprint'] && $counts['status'] == "VERIFY" ) {
                                                $elapsed = $counts['elapsed'];
                                                $estimated = $counts['estimated'];
                                            }
                                        }
                                        echo ($elapsed.'/'.$estimated );
                                    ?>
                                </div>
                                <div class="pr-4 ml-0 mr-auto">VERIFY</div>
                                
                            </div>
                                <div style="background-color:#2ea98c; overflow-y:auto; height:79vh;flex-grow: 1; flex-basis: 100%;" class="mb-1 py-1" id="VERIFY-<?=$sprints['id_sprint'];?>"  <?php if(($sprints['end_sprint'] == null || $sprints['end_sprint'] > date('Y-m-d H:i:s', time())) && ($member['position'] !="Product Owner")) {?> ondragover="onDragOverEpic(event);" ondrop="onDropEpic(event);" <?php ;}?>>
                                <?php foreach ($epic as $epics){
                                        if ($epics['status']=="VERIFY" && $epics['id_sprint']==$sprints['id_sprint'] ) {?>
                                        
                                        <!-- Button trigger modal -->
                                        <div class=" d-flex w-100 mx-auto" <?php if(($sprints['end_sprint'] == null || $sprints['end_sprint'] > date('Y-m-d H:i:s', time())) && ($member['position'] !="Product Owner")) {?> ondragstart="onDragStart(event);" id="epic-<?=$epics['id_epic']?>" draggable="true" <?php }?>>
                                            <button type="button" class="p-0 m-1 w-100" data-toggle="modal" data-target="#epic<?=$epics['id_epic'] ;?>">
                                                <?php 
                                                 $semua = 1; $checked = 0;
                                                foreach ($checkboxall as $checkboxalls) {
                                                    if ($checkboxalls['id_epic']==$epics['id_epic']) {
                                                        $semua = $checkboxalls['id_checkbox'];
                                                    }
                                                }
                                                
                                                foreach ($checkboxchecked as $checkboxcheckeds) {
                                                    if ($checkboxcheckeds['id_epic']==$epics['id_epic']) {
                                                        $checked = $checkboxcheckeds['id_checkbox'];
                                                    }
                                                }
                                                // d($checked);
                                                // dd($semua);

                                                ?>
                                                <div class="d-flex" style='background-color:grey;'>
                                                    <div class=' mr-auto ml-0 text-white my-0'  ><?php if($epics['elapsed']==null) {echo 0;} else{ echo $epics['elapsed'];} echo ('/'.$epics['estimated']) ;?></div>
                                                    <div class=' ml-auto mr-0 text-white my-0' ><?php echo (number_format($checked/$semua*100).'%');?></div>
                                                </div>
                                                <div class='mx-auto text-white'  style='background-color:grey;'><?=$epics['isi'] ;?></div>
                                            </button>
                                            </div>
                                            <!-- end Button trigger modal -->
                                            <!-- Modal -->
                                            <div class="modal fade" id="epic<?=$epics['id_epic'];?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                            <div class="modal-content" style="background-color:#2ea98c;">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Task</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form class="" method="post" action="/proyek/editepic/<?=$epics['id_epic'] ;?>">
                                                    <div class="modal-body">
                                                            <?= csrf_field(); ?>
                                                            <input type="hidden" class="form-control" name="id_sprint" value="<?=$sprints['id_sprint'];?>">
                                                            <div class="form-group">
                                                                <label for="status<?=$epics['id_epic']?>" class="text-left" style="float: left; color:black;">To</label>
                                                                <select class="custom-select" name="status<?=$epics['id_epic']?>">
                                                                    <option value="TO DO" >TO DO</option>
                                                                    <option value="ON PROGRESS">ON PROGRESS</option>
                                                                    <option value="VERIFY" selected>VERIFY</option>
                                                                    <option value="DONE">DONE</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-row">
                                                                <div class="form-group col">
                                                                    <label for="Elapsed<?=$epics['id_epic'];?>" style="float: left; color:black;">Dihabiskan</label>
                                                                    <input type="number" class="form-control" name="elapsed<?=$epics['id_epic'];?>" value="<?=$epics['elapsed'];?>">
                                                                    <small class="form-text" style="float: left;">Waktu yang digunakan dalam satuan jam</small>
                                                                </div>
                                                                <div class="form-group col">
                                                                    <label for="estimated<?=$epics['id_epic'];?>" style="float: left; color:black;">Estimasi</label>
                                                                    <input type="number" class="form-control" name="estimated<?=$epics['id_epic'];?>" value="<?=$epics['estimated'];?>">
                                                                    <small class="form-text" style="float: left;">Estimasi waktu pengerjaan dalam satuan jam</small>
                                                                </div>
                                                            </div>
                                                    
                                                            <div class="form-group">
                                                                <label for="isiepic<?=$epics['id_epic']?>" style="float: left; color:black;">Isi</label>
                                                                <textarea class="w-100 <?php if ($validation->hasError('isiepic'.$epics['id_epic'])) {echo 'is-invalid';} ?>" id="isiepic<?=$epics['id_epic'];?>" name="isiepic<?=$epics['id_epic'];?>" rows="2"><?=$epics['isi'];?></textarea>
                                                                <!-- <small id="emailHelp" class="form-text text-muted">enter your email or username</small> -->
                                                                <div class="invalid-feedback text-left">
                                                                    <?=$validation->getError('isiepic'.$epics['id_epic']);?>
                                                                </div>
                                                            </div>
                                                            <div class="ml-0 mr-auto d-flex" style="color:black;"><h4 class="my-auto">Checkbox</h4><?php if(($sprints['end_sprint'] == null || $sprints['end_sprint'] > date('Y-m-d H:i:s', time())) && ($member['position'] !="Product Owner")) {?> <i class="fa fa-plus-circle fa-2x mx-1 my-auto" style="color:blue;" data-toggle="modal" data-target="#createcheckbox<?=$epics['id_epic']?>"></i> <?php }?></div>
                                                            <?php foreach ($checkbox as $checkboxes) {
                                                                if ($checkboxes['id_epic']==$epics['id_epic']) {?>
                                                                     <div class="input-group mb-3">
                                                                        <div class="input-group-prepend">
                                                                            <div class="input-group-text">
                                                                            <input type="checkbox" name="checkbox[]" value="<?=$checkboxes['id_checkbox'];?>" <?php if($checkboxes['value']=='1') {echo "checked";}?> >
                                                                            </div>
                                                                        </div>
                                                                        <input type="text" class="form-control" aria-label="Text input with checkbox" value="<?=$checkboxes['isi'];?>" disabled>
                                                                        
                                                                        <a href="<?=base_url('proyek/deleteCheckbox/'.$checkboxes['id_checkbox'])?>" class="fa fa-minus-circle fa-2x my-auto  mx-1" style="color:red;"></a>
                                                                        

                                                                    </div>
                                                            <?php    }
                                                            }?>
                                                        </div>
                                                        <div class="modal-footer">
                                                        <?php if($epics['editor_epic']==null){?>
                                                            <p class="ml-0 mr-auto" style="color:black;">Dibuat oleh <?= $epics['nama_pembuat'];?></p>
                                                        <?php } else{?>
                                                            <p class="ml-0 mr-auto" style="color:black;">Diubah oleh <?= $epics['nama_pengedit'];?></p>
                                                        <?php } ?> 
                                                        <?php if(($sprints['end_sprint'] == null || $sprints['end_sprint'] > date('Y-m-d H:i:s', time())) && ($member['position'] !="Product Owner")) {?>
                                                            <button type="submit" class="btn btn-danger" value="delete" name="submit">Hapus Task</button>
                                                            <button type="submit" class="btn btn-success" value="edit" name="submit">Ubah Task</button>
                                            <?php }?>
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                                        </form>
                                                    </div>
                                                </div>

                                            </div>
                                            </div>
                                            <div class="modal fade" id="createcheckbox<?=$epics['id_epic']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                            <div class="modal-dialog modal-dialog-centered modal-lg" >
                                                                            <div class="modal-content" style="background-color:#fbeeac;">
                                                                                    <div class="modal-header">
                                                                                        <h5 class="modal-title" id="exampleModalLabel">Tambah Checkbox</h5>
                                                                                        <button type="button" class="close" data-dismiss="modal" data-target="#createcheckbox<?=$epics['id_epic']?>" aria-label="Close">
                                                                                        <span aria-hidden="true">&times;</span>
                                                                                        </button>
                                                                                    </div>
                                                                                    <form class="" method="post" action="/proyek/createCheckbox/<?=$epics['id_epic']?>">
                                                                                    <div class="modal-body">
                                                                                            <?= csrf_field(); ?>
                                                                                            <div class="form-group">
                                                                                                <label for="#isicheckbox<?=$epics['id_epic']?>" style="float: left; color:black;">Isi</label>
                                                                                                <input type="text" class="form-control <?php if ($validation->hasError('isicheckbox'.$epics['id_epic'])) {echo 'is-invalid';} ?>" name="isicheckbox<?=$epics['id_epic']?>" value="">
                                                                                                <!-- <small id="emailHelp" class="form-text text-muted">enter your email or username</small> -->
                                                                                                <div class="invalid-feedback">
                                                                                                    <?=$validation->getError('isicheckbox'.$epics['id_epic']);?>
                                                                                                </div>
                                                                                            </div>
                                                                                    </div>
                                                                                    <div class="modal-footer">
                                                                                        <button type="submit" class="btn btn-success">Tambah Checkbox</button>
                                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal" >Tutup</button>
                                                                                    </div>
                                                                                    </form>
                                                                                </div>

                                                                            </div>
                                                                            </div>
                                        <!-- end modal-->


                                        <?php 
                                        if ($validation->hasError('isiepic'.$epics['id_epic'])||session()->getFlashdata('epic')==$epics['id_epic'] ) { 
                                            echo "<script> $('#epic".$epics['id_epic']."').modal('show'); </script>";
                                           
                                            ;} 
                                        elseif ($validation->hasError('isicheckbox'.$epics['id_epic'])) {
                                            echo "<script> $('#epic".$epics['id_epic']."').modal('show'); </script>";
                                            echo "<script> $('#createcheckbox".$epics['id_epic']."').modal('show'); </script>";
                                        }?>
                                        <?php
                                        }
                                    }
                                    ?>
                                </div>

                            </div>
                            <div class="px-1 pt-1 pb-1 text-white text-center m-0" style=" width: 450px; height:100%; background-color:#1e6f5c;">
                            <div style="background-color:#111111;" class="d-flex"> 
                                <div class="text-center  ml-2 mr-auto" >
                                    <?php $elapsed = 0; $estimated = 0;
                                        foreach ($count as $counts) {
                                            if ($counts['id_sprint'] == $sprints['id_sprint'] && $counts['status'] == "DONE" ) {
                                                $elapsed = $counts['elapsed'];
                                                $estimated = $counts['estimated'];
                                            }
                                        }
                                        echo ($elapsed.'/'.$estimated );
                                    ?>
                                </div>
                                <div class="pr-4 ml-0 mr-auto">DONE</div>
                                
                            </div>
                                <div style="background-color:#1e6f5c; overflow-y:auto; height:79vh;flex-grow: 1; flex-basis: 100%;" class="mb-1 py-1" id="DONE-<?=$sprints['id_sprint'];?>" <?php if(($sprints['end_sprint'] == null || $sprints['end_sprint'] > date('Y-m-d H:i:s', time())) && ($member['position'] !="Product Owner")) {?> ondragover="onDragOverEpic(event);" ondrop="onDropEpic(event);" <?php ;} ?>>
                                <?php foreach ($epic as $epics){
                                        if ($epics['status']=="DONE" && $epics['id_sprint']==$sprints['id_sprint'] ) {?>
                                        
                                        <!-- Button trigger modal -->
                                        <div class=" d-flex w-100 mx-auto" <?php if(($sprints['end_sprint'] == null || $sprints['end_sprint'] > date('Y-m-d H:i:s', time())) && ($member['position'] !="Product Owner")) {?> ondragstart="onDragStart(event);" id="epic-<?=$epics['id_epic']?>" draggable="true" <?php } ?>>
                                            <button type="button" class="p-0 m-1 w-100" data-toggle="modal" data-target="#epic<?=$epics['id_epic'] ;?>">
                                            <?php 
                                                 $semua = 1; $checked = 0;
                                                foreach ($checkboxall as $checkboxalls) {
                                                    if ($checkboxalls['id_epic']==$epics['id_epic']) {
                                                        $semua = $checkboxalls['id_checkbox'];
                                                    }
                                                }
                                                
                                                foreach ($checkboxchecked as $checkboxcheckeds) {
                                                    if ($checkboxcheckeds['id_epic']==$epics['id_epic']) {
                                                        $checked = $checkboxcheckeds['id_checkbox'];
                                                    }
                                                }
                                                // d($checked);
                                                // dd($semua);

                                                ?>
                                                <div class="d-flex" style='background-color:grey;'>
                                                    <div class=' mr-auto ml-0 text-white my-0'  ><?php if($epics['elapsed']==null) {echo 0;} else{ echo $epics['elapsed'];} echo ('/'.$epics['estimated']) ;?></div>
                                                    <div class=' ml-auto mr-0 text-white my-0' ><?php echo (number_format($checked/$semua*100).'%');?></div>
                                                </div>
                                                <div class='mx-auto text-white'  style='background-color:grey;'><?=$epics['isi'] ;?></div>
                                            </button>
                                            </div>
                                            <!-- end Button trigger modal -->
                                            <!-- Modal -->
                                            <div class="modal fade" id="epic<?=$epics['id_epic'];?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style=" overflow-y:auto;">
                                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                            <div class="modal-content" style="background-color:#1e6f5c;">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title text-white" id="exampleModalLabel">Task</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form class="" method="post" action="/proyek/editepic/<?=$epics['id_epic'] ;?>">
                                                    <div class="modal-body">
                                                            <?= csrf_field(); ?>
                                                            <input type="hidden" class="form-control" name="id_sprint" value="<?=$sprints['id_sprint'];?>">
                                                            <div class="form-group">
                                                                <label for="status<?=$epics['id_epic']?>" class="text-left" style="float: left; color:WHITE;">To</label>
                                                                <select class="custom-select" name="status<?=$epics['id_epic']?>">
                                                                    <option value="TO DO" >TO DO</option>
                                                                    <option value="ON PROGRESS">ON PROGRESS</option>
                                                                    <option value="VERIFY">VERIFY</option>
                                                                    <option value="DONE" selected>DONE</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-row">
                                                                <div class="form-group col">
                                                                    <label for="Elapsed<?=$epics['id_epic'];?>" style="float: left; color:white;">Dihabiskan</label>
                                                                    <input type="number" class="form-control" name="elapsed<?=$epics['id_epic'];?>" value="<?=$epics['elapsed'];?>">
                                                                    <small class="form-text" style="float: left;">Waktu yang digunakan dalam satuan jam</small>
                                                                </div>
                                                                <div class="form-group col">
                                                                    <label for="estimated<?=$epics['id_epic'];?>" style="float: left; color:white;">Estimated</label>
                                                                    <input type="number" class="form-control" name="estimated<?=$epics['id_epic'];?>" value="<?=$epics['estimated'];?>">
                                                                    <small class="form-text" style="float: left;">Estimasi waktu pengerjaan dalam satuan jam</small>
                                                                </div>
                                                            </div>
                                                    
                                                            <div class="form-group">
                                                                <label for="isiepic<?=$epics['id_epic']?>" style="float: left; color:white;">Isi</label>
                                                                <textarea class="w-100 <?php if ($validation->hasError('isiepic'.$epics['id_epic'])) {echo 'is-invalid';} ?>" id="isiepic<?=$epics['id_epic'];?>" name="isiepic<?=$epics['id_epic'];?>" rows="2"><?=$epics['isi'];?></textarea>
                                                                <!-- <small id="emailHelp" class="form-text text-muted">enter your email or username</small> -->
                                                                <div class="invalid-feedback text-left">
                                                                    <?=$validation->getError('isiepic'.$epics['id_epic']);?>
                                                                </div>
                                                            </div>
                                                            <div class="ml-0 mr-auto d-flex" ><h4 class="my-auto" style="color:white;">Checkbox</h4><?php if(($sprints['end_sprint'] == null || $sprints['end_sprint'] > date('Y-m-d H:i:s', time())) && ($member['position'] !="Product Owner")) {?> <i class="fa fa-plus-circle fa-2x mx-1 my-auto" style="color:blue;" data-toggle="modal" data-target="#createcheckbox<?=$epics['id_epic']?>"></i> <?php }?></div>
                                                            <?php foreach ($checkbox as $checkboxes) {
                                                                if ($checkboxes['id_epic']==$epics['id_epic']) {?>
                                                                     <div class="input-group mb-3">
                                                                        <div class="input-group-prepend">
                                                                            <div class="input-group-text">
                                                                            <input type="checkbox" name="checkbox[]" value="<?=$checkboxes['id_checkbox'];?>" <?php if($checkboxes['value']=='1') {echo "checked";}?> >
                                                                            </div>
                                                                        </div>
                                                                        <input type="text" class="form-control" aria-label="Text input with checkbox" value="<?=$checkboxes['isi'];?>" disabled>
                                                                        
                                                                        <a href="<?=base_url('proyek/deleteCheckbox/'.$checkboxes['id_checkbox'])?>" class="fa fa-minus-circle fa-2x my-auto  mx-1" style="color:red;"></a>
                                                                        

                                                                    </div>
                                                            <?php    }
                                                            }?>
                                                        </div>
                                                        <div class="modal-footer">
                                                        <?php if($epics['editor_epic']==null){?>
                                                            <p class="ml-0 mr-auto" style="color:white;">Dibuat oleh <?= $epics['nama_pembuat'];?></p>
                                                        <?php } else{?>
                                                            <p class="ml-0 mr-auto" style="color:white;">Diubah oleh <?= $epics['nama_pengedit'];?></p>
                                                        <?php } ?> 
                                                        <?php if(($sprints['end_sprint'] == null || $sprints['end_sprint'] > date('Y-m-d H:i:s', time())) && ($member['position'] !="Product Owner")) {?>
                                                            <button type="submit" class="btn btn-danger" value="delete" name="submit">Hapus Task</button>
                                                            <button type="submit" class="btn btn-success" value="edit" name="submit">Ubah Task</button>
                                                            <?php }?>
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                                        </form>
                                                    </div>
                                                </div>

                                            </div>
                                            </div>
                                            <div class="modal fade" id="createcheckbox<?=$epics['id_epic']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                            <div class="modal-dialog modal-dialog-centered modal-lg" >
                                                                            <div class="modal-content" style="background-color:#fbeeac;">
                                                                                    <div class="modal-header">
                                                                                        <h5 class="modal-title" id="exampleModalLabel">Tambah Checkbox</h5>
                                                                                        <button type="button" class="close" data-dismiss="modal" data-target="#createcheckbox<?=$epics['id_epic']?>" aria-label="Close">
                                                                                        <span aria-hidden="true">&times;</span>
                                                                                        </button>
                                                                                    </div>
                                                                                    <form class="" method="post" action="/proyek/createCheckbox/<?=$epics['id_epic']?>">
                                                                                    <div class="modal-body">
                                                                                            <?= csrf_field(); ?>
                                                                                            <div class="form-group">
                                                                                                <label for="#isicheckbox<?=$epics['id_epic']?>" style="float: left; color:black;">Isi</label>
                                                                                                <input type="text" class="form-control <?php if ($validation->hasError('isicheckbox'.$epics['id_epic'])) {echo 'is-invalid';} ?>" name="isicheckbox<?=$epics['id_epic']?>" value="">
                                                                                                <!-- <small id="emailHelp" class="form-text text-muted">enter your email or username</small> -->
                                                                                                <div class="invalid-feedback">
                                                                                                    <?=$validation->getError('isicheckbox'.$epics['id_epic']);?>
                                                                                                </div>
                                                                                            </div>
                                                                                    </div>
                                                                                    <div class="modal-footer">
                                                                                        <button type="submit" class="btn btn-success">Tambah Checkbox</button>
                                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal" >Tutup</button>
                                                                                    </div>
                                                                                    </form>
                                                                                </div>

                                                                            </div>
                                                                            </div>
                                        <!-- end modal-->


                                        <?php 
                                        if ($validation->hasError('isiepic'.$epics['id_epic'])||session()->getFlashdata('epic')==$epics['id_epic'] ) { 
                                            echo "<script> $('#epic".$epics['id_epic']."').modal('show'); </script>";
                                           
                                            ;} 
                                        elseif ($validation->hasError('isicheckbox'.$epics['id_epic'])) {
                                            echo "<script> $('#epic".$epics['id_epic']."').modal('show'); </script>";
                                            echo "<script> $('#createcheckbox".$epics['id_epic']."').modal('show'); </script>";
                                        }?>
                                        <?php
                                        }
                                    }
                                    ?>
                                </div>

                            </div>
                            <div class="px-1 pt-1 pb-1 text-white text-center m-0" style=" width: 450px; height:100%; background-color:#18594a;">
                            <div style="background-color:#111111;">Retrospective</div>
                                <div style="background-color:#18594a; overflow-y:auto; height:79vh" class="mb-1 py-1">
                                    <?php foreach ($epic as $epics){
                                            if ($epics['status']=="REVIEW" && $epics['id_sprint']==$sprints['id_sprint'] ) {?>
                                            
                                            <!-- Button trigger modal -->
                                            <div class=" d-flex w-100 mx-auto" style=' height:24%;'>
                                                <button type="button" class="p-0 m-1 w-100 h-10" data-toggle="modal" data-target="#epic<?=$epics['id_epic'] ;?>" style='background-color:grey;'>
                                                    <div class='m-auto text-white'  style='background-color:grey;'>SPRINT REVIEW</div>
                                                </button>
                                                </div>
                                                <!-- end Button trigger modal -->
                                                <!-- Modal -->
                                                <div class="modal fade" id="epic<?=$epics['id_epic'];?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style=" overflow-y:auto;">
                                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                                <div class="modal-content" style="background-color:#8be0cc;">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Sprint <?=$ke?> Review</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form class="" method="post" action="/proyek/editepic/<?=$epics['id_epic'] ;?>">
                                                        <div class="modal-body">
                                                                <?= csrf_field(); ?>
                                                                <input type="hidden" name="status<?=$epics['id_epic'] ;?>" value="REVIEW">
                                                                <div class="form-group">
                                                                    <label for="isiepic<?=$epics['id_epic']?>" style="float: left; color:black;">Isi</label>
                                                                    <textarea class="w-100 <?php if ($validation->hasError('isiepic'.$epics['id_epic'])) {echo 'is-invalid';} ?>" id="isiepic<?=$epics['id_epic'];?>" name="isiepic<?=$epics['id_epic'];?>" rows="6"><?=$epics['isi'];?></textarea>
                                                                    <!-- <small id="emailHelp" class="form-text text-muted">enter your email or username</small> -->
                                                                    <div class="invalid-feedback text-left">
                                                                    <?php if ($validation->hasError('isiepic'.$epics['id_epic'])) {echo "Sprint Review Harus Diisi";}?>
                                                                    </div>
                                                                </div>
                                                                <div class="ml-0 mr-auto d-flex" style="color:black;"><h4 class="my-auto">Checkbox</h4><?php if(($sprints['end_sprint'] == null || $sprints['end_sprint'] > date('Y-m-d H:i:s', time())) && ($member['position'] =="Scrum Master")) {?> <i class="fa fa-plus-circle fa-2x mx-1 my-auto" style="color:blue;" data-toggle="modal" data-target="#createcheckbox<?=$epics['id_epic']?>"></i> <?php }?></div>
                                                                <?php foreach ($checkbox as $checkboxes) {
                                                                if ($checkboxes['id_epic']==$epics['id_epic']) {?>
                                                                     <div class="input-group mb-3">
                                                                        <div class="input-group-prepend">
                                                                            <div class="input-group-text">
                                                                            <input type="checkbox" name="checkbox[]" value="<?=$checkboxes['id_checkbox'];?>" <?php if($checkboxes['value']=='1') {echo "checked";}?> >
                                                                            </div>
                                                                        </div>
                                                                        <input type="text" class="form-control" aria-label="Text input with checkbox" value="<?=$checkboxes['isi'];?>" disabled>
                                                                        
                                                                        <a href="<?=base_url('proyek/deleteCheckbox/'.$checkboxes['id_checkbox'])?>" class="fa fa-minus-circle fa-2x my-auto  mx-1" style="color:red;"></a>
                                                                        

                                                                    </div>
                                                            <?php    }
                                                            }?>
                                                            </div>
                                                            <div class="modal-footer">
                                                            <?php if(($sprints['end_sprint'] == null || $sprints['end_sprint'] > date('Y-m-d H:i:s', time())) && ($member['position'] =="Scrum Master")) {?>
                                                                <button type="submit" class="btn btn-success" value="edit" name="submit">Ubah Review</button>
                                                            <?php }?>
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                                            </form>
                                                            </div>
                                                        </div>

                                                        </div>
                                                        </div>
                                                        <div class="modal fade" id="createcheckbox<?=$epics['id_epic']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                                    <div class="modal-dialog modal-dialog-centered modal-lg" >
                                                                                    <div class="modal-content" style="background-color:#fbeeac;">
                                                                                            <div class="modal-header">
                                                                                                <h5 class="modal-title" id="exampleModalLabel">Tambah Checkbox</h5>
                                                                                                <button type="button" class="close" data-dismiss="modal" data-target="#createcheckbox<?=$epics['id_epic']?>" aria-label="Close">
                                                                                                <span aria-hidden="true">&times;</span>
                                                                                                </button>
                                                                                            </div>
                                                                                            <form class="" method="post" action="/proyek/createCheckbox/<?=$epics['id_epic']?>">
                                                                                            <div class="modal-body">
                                                                                                    <?= csrf_field(); ?>
                                                                                                    <div class="form-group">
                                                                                                        <label for="#isicheckbox<?=$epics['id_epic']?>" style="float: left; color:black;">Isi</label>
                                                                                                        <input type="text" class="form-control <?php if ($validation->hasError('isicheckbox'.$epics['id_epic'])) {echo 'is-invalid';} ?>" name="isicheckbox<?=$epics['id_epic']?>" value="">
                                                                                                        <!-- <small id="emailHelp" class="form-text text-muted">enter your email or username</small> -->
                                                                                                        <div class="invalid-feedback">
                                                                                                            <?=$validation->getError('isicheckbox'.$epics['id_epic']);?>
                                                                                                        </div>
                                                                                                    </div>
                                                                                            </div>
                                                                                            <div class="modal-footer">
                                                                                                <button type="submit" class="btn btn-success">Tambah Checkbox</button>
                                                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal" >Tutup</button>
                                                                                            </div>
                                                                                            </form>
                                                                                        </div>

                                                                                    </div>
                                                                                    </div>
                                            <!-- end modal-->


                                                <?php 
                                                if ($validation->hasError('isiepic'.$epics['id_epic'])||session()->getFlashdata('epic')==$epics['id_epic'] ) { 
                                                    echo "<script> $('#epic".$epics['id_epic']."').modal('show'); </script>";
                                                
                                                    ;} 
                                                elseif ($validation->hasError('isicheckbox'.$epics['id_epic'])) {
                                                    echo "<script> $('#epic".$epics['id_epic']."').modal('show'); </script>";
                                                    echo "<script> $('#createcheckbox".$epics['id_epic']."').modal('show'); </script>";
                                                }?>
                                            <?php
                                            }
                                        }
                                        ?>

                                        <?php foreach ($epic as $epics){
                                            if ($epics['status']=="ANALYSIS" && $epics['id_sprint']==$sprints['id_sprint'] ) {?>
                                                <div class=" d-flex w-100 mx-auto" style=' height:24%;'>
                                                <button type="button" class="p-0 m-1 w-100 h-10" data-toggle="modal" data-target="#burndown<?=$sprints['id_sprint'] ;?>" style='background-color:grey;'>
                                                    <div class='m-auto text-white'  style='background-color:grey;'>BURNDOWN CHART</div>
                                                </button>
                                                </div>
                                                <!-- Modal -->
                                                    <div class="modal fade" id="burndown<?=$sprints['id_sprint'] ;?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered modal-xl">
                                                    <div class="modal-content" style="background-color:#8be0cc;">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Sprint <?=$ke?> Burndown Chart</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body mb-2">
                                                            <canvas id="burndownchart<?=$sprints['id_sprint'] ;?>" ></canvas>
                                                            
                                                                <?php 
                                                                 $tanggal=''; $progress='';
                                                                foreach ($countdo as $countdoss) {
                                                                    if ($countdoss['id_sprint'] == $sprints['id_sprint']) {
                                                                        
                                                                    $tanggal="'".$countdoss['tanggal_mulai']."(Start Sprint)',"; 
                                                                    $progress="'".$countdoss['estimated']."' ,";
                                                                }
                                                                }
                                                                foreach ($countdo as $countdos) {
                                                                    if ($countdos['id_sprint'] == $sprints['id_sprint']) {
                                                                        foreach ($log as $logs) { 
                                                                            if ($logs['id_sprint']==$sprints['id_sprint']) {
                                                                                $tanggal.= "'".$logs['tanggal']."' ,";
                                                                                $countdos['estimated'] = $countdos['estimated'] - $logs['sum(progress)'];
                                                                                $progress.="'".($countdos['estimated'])."' ,"; 
                                                                            }
                                                                        }
                                                                    }
                                                                }
                                                                    // echo $banyaknya."<br />".$nama;?>
                                                            <script>
                                                                var ctx = document.getElementById("burndownchart<?=$sprints['id_sprint'] ;?>");
                                                                var myChart = new Chart(ctx, {
                                                                    type: 'line',
                                                                    data: {
                                                                        labels: [<?php echo $tanggal;?>],
                                                                        datasets: [{
                                                                                label: 'Estimated',
                                                                                data: [<?php echo $progress;?>],
                                                                                backgroundColor: 'rgba(0, 175, 145,0.8)',
                                                                                backgroundHover: 'rgba(0, 175, 145,1)',
                                                                                borderColor: 'rgb(0, 121, 101,1)',
                                                                                borderWidth: 1,
                                                                                tension: 0.1
                                                                            }]
                                                                    },
                                                                    options: {
                                                                        responsive: true,
                                                                        scales: {
                                                                            yAxes: [{
                                                                                stacked: true
                                                                                }]
                                                                        }
                                                                    }
                                                                });
                                                            </script>
                                                            </div>
                                                            <div class="modal-footer">
                                                            
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    </div>
                                                <!-- end modal-->
                                            
                                            <!-- Button trigger modal -->
                                            <div class=" d-flex w-100 mx-auto" style=' height:24%;'>
                                                <button type="button" class="p-0 m-1 w-100 h-10" data-toggle="modal" data-target="#epic<?=$epics['id_epic'] ;?>" style='background-color:grey;'>
                                                    <div class='m-auto text-white'  style='background-color:grey;'>RETROSPECTIVE ANALYSIS</div>
                                                </button>
                                                </div>
                                                <!-- end Button trigger modal -->
                                                <!-- Modal -->
                                                <div class="modal fade" id="epic<?=$epics['id_epic'];?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                                <div class="modal-content" style="background-color:#8be0cc;">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Sprint <?=$ke?> Retrospecive Analysis</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form class="" method="post" action="/proyek/editepic/<?=$epics['id_epic'] ;?>">
                                                        <div class="modal-body">
                                                                <?= csrf_field(); ?>
                                                                <input type="hidden" name="status<?=$epics['id_epic'] ;?>" value="ANALYSIS">
                                                                <div class="form-group">
                                                                    <label for="isiepic<?=$epics['id_epic']?>" style="float: left; color:black;">Isi</label>
                                                                    <textarea class="w-100 <?php if ($validation->hasError('isiepic'.$epics['id_epic'])) {echo 'is-invalid';} ?>" id="isiepic<?=$epics['id_epic'];?>" name="isiepic<?=$epics['id_epic'];?>" rows="6"><?=$epics['isi'];?></textarea>
                                                                    <!-- <small id="emailHelp" class="form-text text-muted">enter your email or username</small> -->
                                                                    <div class="invalid-feedback text-left">
                                                                        <?php if ($validation->hasError('isiepic'.$epics['id_epic'])) {echo "Retrospective Analysis Harus Diisi";}?>
                                                                    </div>
                                                                </div>
                                                                <div class="ml-0 mr-auto d-flex" style="color:black;"><h4 class="my-auto">Checkbox</h4><?php if(($sprints['end_sprint'] == null || $sprints['end_sprint'] > date('Y-m-d H:i:s', time())) && ($member['position'] =="Scrum Master")) {?> <i class="fa fa-plus-circle fa-2x mx-1 my-auto" style="color:blue;" data-toggle="modal" data-target="#createcheckbox<?=$epics['id_epic']?>"></i> <?php }?></div>
                                                                <?php foreach ($checkbox as $checkboxes) {
                                                                if ($checkboxes['id_epic']==$epics['id_epic']) {?>
                                                                     <div class="input-group mb-3">
                                                                        <div class="input-group-prepend">
                                                                            <div class="input-group-text">
                                                                            <input type="checkbox" name="checkbox[]" value="<?=$checkboxes['id_checkbox'];?>" <?php if($checkboxes['value']=='1') {echo "checked";}?> >
                                                                            </div>
                                                                        </div>
                                                                        <input type="text" class="form-control" aria-label="Text input with checkbox" value="<?=$checkboxes['isi'];?>" disabled>
                                                                        <?php if(($sprints['end_sprint'] == null || $sprints['end_sprint'] > date('Y-m-d H:i:s', time())) && ($member['position'] =="Scrum Master")) {?>
                                                                            <a href="<?=base_url('proyek/deleteCheckbox/'.$checkboxes['id_checkbox'])?>" class="fa fa-minus-circle fa-2x my-auto  mx-1" style="color:red;"></a>
                                                                        <?php    }?>

                                                                    </div>
                                                            <?php    }
                                                            }?>
                                                            </div>
                                                            <div class="modal-footer">
                                                            <?php if(($sprints['end_sprint'] == null || $sprints['end_sprint'] > date('Y-m-d H:i:s', time())) && ($member['position'] =="Scrum Master")) {?>
                                                                <button type="submit" class="btn btn-success" value="edit" name="submit">Ubah Retrospective Analysis</button>
                                                            <?php }?>
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                                            </form>
                                                        </div>
                                                    </div>

                                                    </div>
                                                    </div><div class="modal fade" id="createcheckbox<?=$epics['id_epic']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                                <div class="modal-dialog modal-dialog-centered modal-lg" >
                                                                                <div class="modal-content" style="background-color:#fbeeac;">
                                                                                        <div class="modal-header">
                                                                                            <h5 class="modal-title" id="exampleModalLabel">Tambah Checkbox</h5>
                                                                                            <button type="button" class="close" data-dismiss="modal" data-target="#createcheckbox<?=$epics['id_epic']?>" aria-label="Close">
                                                                                            <span aria-hidden="true">&times;</span>
                                                                                            </button>
                                                                                        </div>
                                                                                        <form class="" method="post" action="/proyek/createCheckbox/<?=$epics['id_epic']?>">
                                                                                        <div class="modal-body">
                                                                                                <?= csrf_field(); ?>
                                                                                                <div class="form-group">
                                                                                                    <label for="#isicheckbox<?=$epics['id_epic']?>" style="float: left; color:black;">Isi</label>
                                                                                                    <input type="text" class="form-control <?php if ($validation->hasError('isicheckbox'.$epics['id_epic'])) {echo 'is-invalid';} ?>" name="isicheckbox<?=$epics['id_epic']?>" value="">
                                                                                                    <!-- <small id="emailHelp" class="form-text text-muted">enter your email or username</small> -->
                                                                                                    <div class="invalid-feedback">
                                                                                                        <?=$validation->getError('isicheckbox'.$epics['id_epic']);?>
                                                                                                    </div>
                                                                                                </div>
                                                                                        </div>
                                                                                        <div class="modal-footer">
                                                                                            <button type="submit" class="btn btn-success">Tambah Checkbox</button>
                                                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal" >Tutup</button>
                                                                                        </div>
                                                                                        </form>
                                                                                    </div>

                                                                                </div>
                                                                                </div>
                                            <!-- end modal-->


                                            <?php 
                                            if ($validation->hasError('isiepic'.$epics['id_epic'])||session()->getFlashdata('epic')==$epics['id_epic'] ) { 
                                                echo "<script> $('#epic".$epics['id_epic']."').modal('show'); </script>";
                                            
                                                ;} 
                                            elseif ($validation->hasError('isicheckbox'.$epics['id_epic'])) {
                                                echo "<script> $('#epic".$epics['id_epic']."').modal('show'); </script>";
                                                echo "<script> $('#createcheckbox".$epics['id_epic']."').modal('show'); </script>";
                                            }?>
                                            <?php
                                            }
                                        }
                                        ?>
                                        <?php foreach ($epic as $epics){
                                            if ($epics['status']=="ACTION" && $epics['id_sprint']==$sprints['id_sprint'] ) {?>
                                            
                                            <!-- Button trigger modal -->
                                                <div class=" d-flex w-100 mx-auto" style=' height:24%;'>
                                                <button type="button" class="p-0 m-1 w-100 h-10" data-toggle="modal" data-target="#epic<?=$epics['id_epic'] ;?>" style='background-color:grey;'>
                                                    <div class='m-auto text-white'  style='background-color:grey;'>RETROSPECTIVE ACTION</div>
                                                </button>
                                                </div>
                                                <!-- end Button trigger modal -->
                                                <!-- Modal -->
                                                <div class="modal fade" id="epic<?=$epics['id_epic'];?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                                <div class="modal-content" style="background-color:#8be0cc;">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Sprint <?=$ke?> Retrospective Action</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form class="" method="post" action="/proyek/editepic/<?=$epics['id_epic'] ;?>">
                                                        <div class="modal-body">
                                                                <?= csrf_field(); ?>
                                                                <input type="hidden" name="status<?=$epics['id_epic'] ;?>" value="ACTION">
                                                                <div class="form-group">
                                                                    <label for="isiepic<?=$epics['id_epic']?>" style="float: left; color:black;">Isi</label>
                                                                    <textarea class="w-100 <?php if ($validation->hasError('isiepic'.$epics['id_epic'])) {echo 'is-invalid';} ?>" id="isiepic<?=$epics['id_epic'];?>" name="isiepic<?=$epics['id_epic'];?>" rows="6"><?=$epics['isi'];?></textarea>
                                                                    <!-- <small id="emailHelp" class="form-text text-muted">enter your email or username</small> -->
                                                                    <div class="invalid-feedback text-left">
                                                                        <?php if ($validation->hasError('isiepic'.$epics['id_epic'])) {echo "Retrospective Action Harus Diisi";}?>
                                                                    </div>
                                                                </div>
                                                                <div class="ml-0 mr-auto d-flex" style="color:black;"><h4 class="my-auto">Checkbox</h4><?php if(($sprints['end_sprint'] == null || $sprints['end_sprint'] > date('Y-m-d H:i:s', time())) && ($member['position'] =="Scrum Master")) {?> <i class="fa fa-plus-circle fa-2x mx-1 my-auto" style="color:blue;" data-toggle="modal" data-target="#createcheckbox<?=$epics['id_epic']?>"></i> <?php }?></div>
                                                                <?php foreach ($checkbox as $checkboxes) {
                                                                if ($checkboxes['id_epic']==$epics['id_epic']) {?>
                                                                     <div class="input-group mb-3">
                                                                        <div class="input-group-prepend">
                                                                            <div class="input-group-text">
                                                                            <input type="checkbox" name="checkbox[]" value="<?=$checkboxes['id_checkbox'];?>" <?php if($checkboxes['value']=='1') {echo "checked";}?> >
                                                                            </div>
                                                                        </div>
                                                                        <input type="text" class="form-control" aria-label="Text input with checkbox" value="<?=$checkboxes['isi'];?>" disabled>
                                                                        <?php if(($sprints['end_sprint'] == null || $sprints['end_sprint'] > date('Y-m-d H:i:s', time())) && ($member['position'] =="Scrum Master")) {?>
                                                                            <a href="<?=base_url('proyek/deleteCheckbox/'.$checkboxes['id_checkbox'])?>" class="fa fa-minus-circle fa-2x my-auto  mx-1" style="color:red;"></a>
                                                                        <?php } ?>

                                                                    </div>
                                                            <?php    }
                                                            }?>
                                                            </div>
                                                            <div class="modal-footer">
                                                            <?php if(($sprints['end_sprint'] == null || $sprints['end_sprint'] > date('Y-m-d H:i:s', time())) && ($member['position'] =="Scrum Master")) {?>
                                                                <button type="submit" class="btn btn-success" value="edit" name="submit">Ubah Retrospective Action</button>
                                                            <?php }?>
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                                            </form>
                                                        </div>
                                                    </div>

                                                </div>
                                                </div><div class="modal fade" id="createcheckbox<?=$epics['id_epic']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                            <div class="modal-dialog modal-dialog-centered modal-lg" >
                                                                            <div class="modal-content" style="background-color:#fbeeac;">
                                                                                    <div class="modal-header">
                                                                                        <h5 class="modal-title" id="exampleModalLabel">Tambah Checkbox</h5>
                                                                                        <button type="button" class="close" data-dismiss="modal" data-target="#createcheckbox<?=$epics['id_epic']?>" aria-label="Close">
                                                                                        <span aria-hidden="true">&times;</span>
                                                                                        </button>
                                                                                    </div>
                                                                                    <form class="" method="post" action="/proyek/createCheckbox/<?=$epics['id_epic']?>">
                                                                                    <div class="modal-body">
                                                                                            <?= csrf_field(); ?>
                                                                                            <div class="form-group">
                                                                                                <label for="#isicheckbox<?=$epics['id_epic']?>" style="float: left; color:black;">Isi</label>
                                                                                                <input type="text" class="form-control <?php if ($validation->hasError('isicheckbox'.$epics['id_epic'])) {echo 'is-invalid';} ?>" name="isicheckbox<?=$epics['id_epic']?>" value="">
                                                                                                <!-- <small id="emailHelp" class="form-text text-muted">enter your email or username</small> -->
                                                                                                <div class="invalid-feedback">
                                                                                                    <?=$validation->getError('isicheckbox'.$epics['id_epic']);?>
                                                                                                </div>
                                                                                            </div>
                                                                                    </div>
                                                                                    <div class="modal-footer">
                                                                                        <button type="submit" class="btn btn-success">Tambah Checkbox</button>
                                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal" >Tutup</button>
                                                                                    </div>
                                                                                    </form>
                                                                                </div>

                                                                            </div>
                                                                            </div>
                                        <!-- end modal-->


                                        <?php 
                                        if ($validation->hasError('isiepic'.$epics['id_epic'])||session()->getFlashdata('epic')==$epics['id_epic'] ) { 
                                            echo "<script> $('#epic".$epics['id_epic']."').modal('show'); </script>";
                                           
                                            ;} 
                                        elseif ($validation->hasError('isicheckbox'.$epics['id_epic'])) {
                                            echo "<script> $('#epic".$epics['id_epic']."').modal('show'); </script>";
                                            echo "<script> $('#createcheckbox".$epics['id_epic']."').modal('show'); </script>";
                                        }?>

                                                
                                            <?php
                                            }
                                        }
                                        ?>
                                    
                                </div>

                            </div>
                            
                        </div>
                    </div>
                    
                </div>
            <?php  }?>
            </div>

        </div>


        <?php //jika salah auto membuka model kembali
    if ($validation->hasError('isibacklog') ) {
        echo "<script> $('#createbacklog').modal('show'); </script>";
    }
    ?>
<!-- end sprint -->

    </div>
    </div>
    </div>