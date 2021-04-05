<div id="content" class="mr-0 pr-0 ml-2 pl-2 pt-4" style="width:99%; height:99%">
    

    <div class="ml-auto mr-auto pt-4" style="overflow-y:auto; display: flex; height : 100%; width:95%; background-color:#fbeeac">
        <div class="p-0 mt-0" style="background-color:#dcf5ef; width : 25%; height:100%; max-height:90%; ">
            <!-- Button trigger modal -->
                <div class="d-flex" style="background-color:#fbeeac;">
                    <h6 class="text-center pb-2 pl-4 mr-0 ml-auto" >Product Backlog</h6>
                    <span class="fa fa-plus py-1 mr-2 ml-auto" data-toggle="modal" data-target="#createbacklog" style="z-index:2;"></span>
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
                                    <textarea class="w-100 <?php if ($validation->hasError('isi')) {echo 'is-invalid';} ?>" id="isi" name="isi"></textarea>
                                    <!-- <small id="emailHelp" class="form-text text-muted">enter your email or username</small> -->
                                    <div class="invalid-feedback">
                                        <?=$validation->getError('isi');?>
                                        <?=session()->getFlashData('isi');?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="#point" style="float: left; color:black;">Storypoint</label>
                                    <input type="number" class="form-control" name="point" value="<?=old('point')?>">
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

                <div style=" overflow-y:auto; height:585px; max-height:40%; min-height:40%; background-color:" class="mb-1 mt-2 mx-1">
                    <?php foreach ($backlog as $backlogs) {
                        if ($backlogs['sprint'] == null) {?>
                            <!-- Button trigger modal -->
                            <div class=" d-flex w-100 mx-auto">
                            <button type="button" class="p-0 m-1 w-100" data-toggle="modal" data-target="#backlog<?=$backlogs['id_backlog'];?>">

                                <div class='pr-1 ml-auto text-white text-right my-0'  style='background-color:grey;'><?=$backlogs['point'] ;?></div>
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
                                                    <option value="Sprint Backlog" >Sprint Backlog</option>
                                                </select>
                                            </div>
                                    
                                            <div class="form-group">
                                                <label for="isi<?=$backlogs['id_backlog'];?>" style="float: left; color:black;">Isi</label>
                                                <textarea class="w-100 <?php if ($validation->hasError('isi'.$backlogs['id_backlog'])) {echo 'is-invalid';} ?>" id="isi<?=$backlogs['id_backlog'];?>" name="isi<?=$backlogs['id_backlog'];?>" rows="2"><?=$backlogs['isi'];?></textarea>
                                                <!-- <small id="emailHelp" class="form-text text-muted">enter your email or username</small> -->
                                                <div class="invalid-feedback">
                                                    <?=$validation->getError('isi'.$backlogs['id_backlog']);?>
                                                    <?=session()->getFlashData('isi'.$backlogs['id_backlog']);?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="point" style="float: left; color:black;">Storypoint</label>
                                                <input type="number" class="form-control" name="point" value="<?=$backlogs['point'];?>">
                                                <!-- <small id="emailHelp" class="form-text text-muted">enter your email or username</small> -->
                                            </div>
                                    </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-danger" value="delete" name="submit">Hapus Backlog</button>
                                            <button type="submit" class="btn btn-success" value="edit" name="submit">Ubah Backlog</button>
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                        </form>
                                    </div>
                                </div>

                            </div>
                            </div>
                        <!-- end modal-->
                        <?php 
                        if ($validation->hasError('isi'.$backlogs['id_backlog'])) { 
                            echo "<script> $('#backlog".$backlogs['id_backlog']."').modal('show'); </script>";
                            ;} ?>
                        </td>
                       <?php }
                    }?>
                </div>
        </div>
        
        <div class="p-0 m-0" style="background-color:#fbeeac;  height:100%;max-height:90%; width : 75%;  ">
            <h6 class="text-center">Sprint</h6>
            <div style="overflow-y:auto;  height:605px ">
            <?php $ke=0; foreach ($sprint as $sprints) {?>
                <div class=" p-0 mx-0" style="background-color:blue;  width : 100%;">   
                    <h6 class="text-center text-white">Sprint <?=++$ke?></h6>

                    <div class="m-0 p-0" style="background-color:white; overflow-x:scroll; height : 100%;  ">
                        <div style="width : 2700px; display: flex;">
                            <div class=" p-0 text-white text-center " style="background-color:#c5efe5; width: 450px; height:100%">

                                <div style="background-color:#111111; height: 100%; width:97%;" class="mx-auto mt-1" >
                                    Sprint Goal
                                    <div style="background-color:#c5efe5; height: 75px; overflow:auto;" class="mb-1 py-1">

                                    <!-- Button trigger modal -->
                                    <div class=" d-flex w-100 mx-auto">
                                    <button type="button" class="p-0 m-1 w-100" data-toggle="modal" data-target="#sprint<?=$sprints['id_sprint'];?>">

                                        
                                            <?php 
                                            if($sprints['goal'] == null) {
                                                echo "<div class='mx-auto'  style='background-color:grey; color:black;'><i>isi sprint goal...</i>";
                                            }
                                            else {
                                                echo "<div class='mx-auto text-white'  style='background-color:grey;'>".$sprints['goal'];
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
                                                    <button type="submit" class="btn btn-success">Ubah Sprint Goal</button>
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                                </form>
                                            </div>
                                        </div>

                                    </div>
                                    </div>
                                <!-- end modal-->
                                     
                                    </div>

                                </div>

                                <div style="background-color:#111111;  height: 40%; width:97%;" class="mx-auto mb-1">
                                    Sprint Backlog
                                    <div style="background-color:#c5efe5; overflow-y:auto; height: 400px; " class="mb-1 py-1">
                                    <?php foreach ($backlog as $backlogs){
                                        if ($backlogs['sprint']==$sprints['id_sprint']) {?>
                                        <!-- Button trigger modal -->
                                            <div class=" d-flex w-100 mx-auto">
                                            <button type="button" class="p-0 m-1 w-100" data-toggle="modal" data-target="#backlog<?=$backlogs['id_backlog'];?>">

                                                <div class='pr-1 ml-auto text-white text-right my-0'  style='background-color:grey;'><?=$backlogs['point'] ;?></div>
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
                                                                    <option value="Product Backlog"  >Product Backlog</option>
                                                                    <option value="Sprint Backlog" selected >Sprint Backlog</option>
                                                                </select>
                                                            </div>
                                                    
                                                            <div class="form-group">
                                                                <label for="isi<?=$backlogs['id_backlog'];?>" style="float: left; color:black;">Isi</label>
                                                                <textarea class="w-100 <?php if ($validation->hasError('isi'.$backlogs['id_backlog'])) {echo 'is-invalid';} ?>" id="isi<?=$backlogs['id_backlog'];?>" name="isi<?=$backlogs['id_backlog'];?>" rows="2"><?=$backlogs['isi'];?></textarea>
                                                                <!-- <small id="emailHelp" class="form-text text-muted">enter your email or username</small> -->
                                                                <div class="invalid-feedback">
                                                                    <?=$validation->getError('isi'.$backlogs['id_backlog']);?>
                                                                    <?=session()->getFlashData('isi'.$backlogs['id_backlog']);?>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="point" style="float: left; color:black;">Storypoint</label>
                                                                <input type="number" class="form-control" name="point" value="<?=$backlogs['point'];?>">
                                                                <!-- <small id="emailHelp" class="form-text text-muted">enter your email or username</small> -->
                                                            </div>
                                                    </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-danger" value="delete" name="submit">Hapus Backlog</button>
                                                            <button type="submit" class="btn btn-success" value="edit" name="submit">Ubah Backlog</button>
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                                        </form>
                                                    </div>
                                                </div>

                                            </div>
                                            </div>
                                        <!-- end modal-->
                                        
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
                                    <div class="text-center  pl-4 mr-0 ml-auto" >To Do</div>
                                    <span class="fa fa-plus py-1 mr-2 ml-auto" data-toggle="modal" data-target="#createepic" style="z-index:2;"></span>
                                </div>
                                <!-- end Button trigger modal -->
                                <!-- Modal -->
                                <div class="modal fade" id="createepic" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg" >
                                <div class="modal-content" style="background-color:#fbeeac;">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Tambah Epic</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form class="" method="post" action="/proyek/createepic">
                                        <div class="modal-body">
                                            <?= csrf_field(); ?>
                                            <input type="hidden" class="form-control" name="id_sprint" value="<?=$sprints['id_sprint']?>" >
                                            <div class="form-group form-row">
                                                <label for="estimated" class="col-2 text-left" style="float: left; color:black;">Estimated</label>
                                                <input type="number" class="form-control col-10" name="estimated" value="<?= old('estimated')?>">
                                            </div>
                                            <div class="form-row" >
                                                <label for="isi" class="col-2 text-left" style="float: left; color:black;">Isi</label>
                                                <textarea class="w-100 col-10 <?php if ($validation->hasError('isi')) {echo 'is-invalid';} ?>" rows="2" id="isi" name="isi" ><?= old('isi')?></textarea>
                                                <div class="invalid-feedback text-left">
                                                    <?=$validation->getError('isi');?>
                                                </div>
                                            </div>
                                        </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-success">Tambah Epic</button>
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                            </form>
                                        </div>
                                    </div>

                                </div>
                                </div>
                            <!-- end modal-->
                                <div style="background-color:; overflow-y:auto; height:500px" class="mb-1 py-1">
                                    <?php foreach ($epic as $epics){
                                        if ($epics['status']=="TO DO" && $epics['id_sprint']==$sprints['id_sprint'] ) {?>
                                        
                                        <!-- Button trigger modal -->
                                        <div class=" d-flex w-100 mx-auto">
                                            <button type="button" class="p-0 m-1 w-100" data-toggle="modal" data-target="#epic<?=$epics['id_epic'] ;?>">

                                                <div class='pr-1 ml-auto text-white text-right my-0'  style='background-color:grey;'><?php if($epics['elapsed']==null) {echo 0;} else{ echo $epics['elapsed'];} echo ('/'.$epics['estimated']) ;?></div>
                                                <div class='mx-auto text-white'  style='background-color:grey;'><?=$epics['isi'] ;?></div>
                                            </button>
                                            </div>
                                            <!-- end Button trigger modal -->
                                            <!-- Modal -->
                                            <div class="modal fade" id="epic<?=$epics['id_epic'];?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                            <div class="modal-content" style="background-color:#8be0cc;">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Epic</h5>
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
                                                                    <option value="TO DO"  selected>TO DO</option>
                                                                    <option value="ON PROGRESS">ON PROGRESS</option>
                                                                    <option value="VERIFY">VERIFY</option>
                                                                    <option value="DONE">DONE</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-row">
                                                                <div class="form-group col">
                                                                    <label for="Elapsed<?=$epics['id_epic'];?>" style="float: left; color:black;">Elapsed</label>
                                                                    <input type="number" class="form-control" name="elapsed<?=$epics['id_epic'];?>" value="<?=$epics['elapsed'];?>">
                                                                    <!-- <small id="emailHelp" class="form-text text-muted">enter your email or username</small> -->
                                                                </div>
                                                                <div class="form-group col">
                                                                    <label for="estimated<?=$epics['id_epic'];?>" style="float: left; color:black;">Estimated</label>
                                                                    <input type="number" class="form-control" name="estimated<?=$epics['id_epic'];?>" value="<?=$epics['estimated'];?>">
                                                                    <!-- <small id="emailHelp" class="form-text text-muted">enter your email or username</small> -->
                                                                </div>
                                                            </div>
                                                    
                                                            <div class="form-group">
                                                                <label for="isi<?=$epics['id_epic']?>" style="float: left; color:black;">Isi</label>
                                                                <textarea class="w-100 <?php if ($validation->hasError('isi'.$epics['id_epic'])) {echo 'is-invalid';} ?>" id="isi<?=$epics['id_epic'];?>" name="isi<?=$epics['id_epic'];?>" rows="2"><?=$epics['isi'];?></textarea>
                                                                <!-- <small id="emailHelp" class="form-text text-muted">enter your email or username</small> -->
                                                                <div class="invalid-feedback text-left">
                                                                    <?=$validation->getError('isi'.$epics['id_epic']);?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-danger" value="delete" name="submit">Hapus Epic</button>
                                                            <button type="submit" class="btn btn-success" value="edit" name="submit">Ubah Epic</button>
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                                        </form>
                                                    </div>
                                                </div>

                                            </div>
                                            </div>
                                        <!-- end modal-->


                                        <?php 
                                        if ($validation->hasError('isi'.$epics['id_epic'])) { 
                                            echo "<script> $('#epic".$epics['id_epic']."').modal('show'); </script>";
                                            ;} ?>
                                        <?php
                                        }
                                    }
                                    ?>
                                </div>

                            </div>
                            <div class="px-1 pt-1 pb-1 text-white text-center m-0" style="background-color:#51d0b2; width: 450px; height:100%;">
                            <div style="background-color:#111111;"> On Progress</div>
                                <div style="background-color:#51d0b2; overflow-y:auto; height:500px" class="mb-1 py-1">
                                <?php foreach ($epic as $epics){
                                        if ($epics['status']=="ON PROGRESS" && $epics['id_sprint']==$sprints['id_sprint'] ) {?>
                                        
                                        <!-- Button trigger modal -->
                                        <div class=" d-flex w-100 mx-auto">
                                            <button type="button" class="p-0 m-1 w-100" data-toggle="modal" data-target="#epic<?=$epics['id_epic'] ;?>">

                                                <div class='pr-1 ml-auto text-white text-right my-0'  style='background-color:grey;'><?php if($epics['elapsed']==null) {echo 0;} else{ echo $epics['elapsed'];} echo ('/'.$epics['estimated']) ;?></div>
                                                <div class='mx-auto text-white'  style='background-color:grey;'><?=$epics['isi'] ;?></div>
                                            </button>
                                            </div>
                                            <!-- end Button trigger modal -->
                                            <!-- Modal -->
                                            <div class="modal fade" id="epic<?=$epics['id_epic'];?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                            <div class="modal-content" style="background-color:#51d0b2;">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Epic</h5>
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
                                                                    <label for="Elapsed<?=$epics['id_epic'];?>" style="float: left; color:black;">Elapsed</label>
                                                                    <input type="number" class="form-control" name="elapsed<?=$epics['id_epic'];?>" value="<?=$epics['elapsed'];?>">
                                                                    <!-- <small id="emailHelp" class="form-text text-muted">enter your email or username</small> -->
                                                                </div>
                                                                <div class="form-group col">
                                                                    <label for="estimated<?=$epics['id_epic'];?>" style="float: left; color:black;">Estimated</label>
                                                                    <input type="number" class="form-control" name="estimated<?=$epics['id_epic'];?>" value="<?=$epics['estimated'];?>">
                                                                    <!-- <small id="emailHelp" class="form-text text-muted">enter your email or username</small> -->
                                                                </div>
                                                            </div>
                                                    
                                                            <div class="form-group">
                                                                <label for="isi<?=$epics['id_epic']?>" style="float: left; color:black;">Isi</label>
                                                                <textarea class="w-100 <?php if ($validation->hasError('isi'.$epics['id_epic'])) {echo 'is-invalid';} ?>" id="isi<?=$epics['id_epic'];?>" name="isi<?=$epics['id_epic'];?>" rows="2"><?=$epics['isi'];?></textarea>
                                                                <!-- <small id="emailHelp" class="form-text text-muted">enter your email or username</small> -->
                                                                <div class="invalid-feedback text-left">
                                                                    <?=$validation->getError('isi'.$epics['id_epic']);?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-danger" value="delete" name="submit">Hapus Epic</button>
                                                            <button type="submit" class="btn btn-success" value="edit" name="submit">Ubah Epic</button>
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                                        </form>
                                                    </div>
                                                </div>

                                            </div>
                                            </div>
                                        <!-- end modal-->


                                        <?php 
                                        if ($validation->hasError('isi'.$epics['id_epic'])) { 
                                            echo "<script> $('#epic".$epics['id_epic']."').modal('show'); </script>";
                                            ;} ?>
                                        <?php
                                        }
                                    }
                                    ?>
                                </div>

                            </div>
                            <div class="px-1 pt-1 pb-1 text-white text-center m-0" style="background-color:#2ea98c; width: 450px; height:100%;">
                            <div style="background-color:#111111;">Verify</div>
                                <div style="background-color:#2ea98c; overflow-y:auto; height:500px" class="mb-1 py-1">
                                <?php foreach ($epic as $epics){
                                        if ($epics['status']=="VERIFY" && $epics['id_sprint']==$sprints['id_sprint'] ) {?>
                                        
                                        <!-- Button trigger modal -->
                                        <div class=" d-flex w-100 mx-auto">
                                            <button type="button" class="p-0 m-1 w-100" data-toggle="modal" data-target="#epic<?=$epics['id_epic'] ;?>">

                                                <div class='pr-1 ml-auto text-white text-right my-0'  style='background-color:grey;'><?php if($epics['elapsed']==null) {echo 0;} else{ echo $epics['elapsed'];} echo ('/'.$epics['estimated']) ;?></div>
                                                <div class='mx-auto text-white'  style='background-color:grey;'><?=$epics['isi'] ;?></div>
                                            </button>
                                            </div>
                                            <!-- end Button trigger modal -->
                                            <!-- Modal -->
                                            <div class="modal fade" id="epic<?=$epics['id_epic'];?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                            <div class="modal-content" style="background-color:#2ea98c;">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Epic</h5>
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
                                                                    <label for="Elapsed<?=$epics['id_epic'];?>" style="float: left; color:black;">Elapsed</label>
                                                                    <input type="number" class="form-control" name="elapsed<?=$epics['id_epic'];?>" value="<?=$epics['elapsed'];?>">
                                                                    <!-- <small id="emailHelp" class="form-text text-muted">enter your email or username</small> -->
                                                                </div>
                                                                <div class="form-group col">
                                                                    <label for="estimated<?=$epics['id_epic'];?>" style="float: left; color:black;">Estimated</label>
                                                                    <input type="number" class="form-control" name="estimated<?=$epics['id_epic'];?>" value="<?=$epics['estimated'];?>">
                                                                    <!-- <small id="emailHelp" class="form-text text-muted">enter your email or username</small> -->
                                                                </div>
                                                            </div>
                                                    
                                                            <div class="form-group">
                                                                <label for="isi<?=$epics['id_epic']?>" style="float: left; color:black;">Isi</label>
                                                                <textarea class="w-100 <?php if ($validation->hasError('isi'.$epics['id_epic'])) {echo 'is-invalid';} ?>" id="isi<?=$epics['id_epic'];?>" name="isi<?=$epics['id_epic'];?>" rows="2"><?=$epics['isi'];?></textarea>
                                                                <!-- <small id="emailHelp" class="form-text text-muted">enter your email or username</small> -->
                                                                <div class="invalid-feedback text-left">
                                                                    <?=$validation->getError('isi'.$epics['id_epic']);?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-danger" value="delete" name="submit">Hapus Epic</button>
                                                            <button type="submit" class="btn btn-success" value="edit" name="submit">Ubah Epic</button>
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                                        </form>
                                                    </div>
                                                </div>

                                            </div>
                                            </div>
                                        <!-- end modal-->


                                        <?php 
                                        if ($validation->hasError('isi'.$epics['id_epic'])) { 
                                            echo "<script> $('#epic".$epics['id_epic']."').modal('show'); </script>";
                                            ;} ?>
                                        <?php
                                        }
                                    }
                                    ?>
                                </div>

                            </div>
                            <div class="px-1 pt-1 pb-1 text-white text-center m-0" style=" width: 450px; height:100%; background-color:#1e6f5c;">
                            <div style="background-color:#111111;">Done</div>
                                <div style="background-color:#1e6f5c; overflow-y:auto; height:500px" class="mb-1 py-1">
                                <?php foreach ($epic as $epics){
                                        if ($epics['status']=="DONE" && $epics['id_sprint']==$sprints['id_sprint'] ) {?>
                                        
                                        <!-- Button trigger modal -->
                                        <div class=" d-flex w-100 mx-auto">
                                            <button type="button" class="p-0 m-1 w-100" data-toggle="modal" data-target="#epic<?=$epics['id_epic'] ;?>">

                                                <div class='pr-1 ml-auto text-white text-right my-0'  style='background-color:grey;'><?php if($epics['elapsed']==null) {echo 0;} else{ echo $epics['elapsed'];} echo ('/'.$epics['estimated']) ;?></div>
                                                <div class='mx-auto text-white'  style='background-color:grey;'><?=$epics['isi'] ;?></div>
                                            </button>
                                            </div>
                                            <!-- end Button trigger modal -->
                                            <!-- Modal -->
                                            <div class="modal fade" id="epic<?=$epics['id_epic'];?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                            <div class="modal-content" style="background-color:#1e6f5c;">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title text-white" id="exampleModalLabel">Epic</h5>
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
                                                                    <option value="VERIFIED">VERIFIED</option>
                                                                    <option value="DONE" selected>DONE</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-row">
                                                                <div class="form-group col">
                                                                    <label for="Elapsed<?=$epics['id_epic'];?>" style="float: left; color:white;">Elapsed</label>
                                                                    <input type="number" class="form-control" name="elapsed<?=$epics['id_epic'];?>" value="<?=$epics['elapsed'];?>">
                                                                    <!-- <small id="emailHelp" class="form-text text-muted">enter your email or username</small> -->
                                                                </div>
                                                                <div class="form-group col">
                                                                    <label for="estimated<?=$epics['id_epic'];?>" style="float: left; color:white;">Estimated</label>
                                                                    <input type="number" class="form-control" name="estimated<?=$epics['id_epic'];?>" value="<?=$epics['estimated'];?>">
                                                                    <!-- <small id="emailHelp" class="form-text text-muted">enter your email or username</small> -->
                                                                </div>
                                                            </div>
                                                    
                                                            <div class="form-group">
                                                                <label for="isi<?=$epics['id_epic']?>" style="float: left; color:white;">Isi</label>
                                                                <textarea class="w-100 <?php if ($validation->hasError('isi'.$epics['id_epic'])) {echo 'is-invalid';} ?>" id="isi<?=$epics['id_epic'];?>" name="isi<?=$epics['id_epic'];?>" rows="2"><?=$epics['isi'];?></textarea>
                                                                <!-- <small id="emailHelp" class="form-text text-muted">enter your email or username</small> -->
                                                                <div class="invalid-feedback text-left">
                                                                    <?=$validation->getError('isi'.$epics['id_epic']);?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-danger" value="delete" name="submit">Hapus Epic</button>
                                                            <button type="submit" class="btn btn-success" value="edit" name="submit">Ubah Epic</button>
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                                        </form>
                                                    </div>
                                                </div>

                                            </div>
                                            </div>
                                        <!-- end modal-->


                                        <?php 
                                        if ($validation->hasError('isi'.$epics['id_epic'])) { 
                                            echo "<script> $('#epic".$epics['id_epic']."').modal('show'); </script>";
                                            ;} ?>
                                        <?php
                                        }
                                    }
                                    ?>
                                </div>

                            </div>
                            <div class="px-1 pt-1 pb-1 text-white text-center m-0" style=" width: 450px; height:100%; background-color:#18594a;">
                            <div style="background-color:#111111;">Retrospective</div>
                                <div style="background-color:#18594a; overflow-y:auto; height:500px" class="mb-1 py-1">
                                <?php foreach ($epic as $epics){
                                        if ($epics['status']=="DONE") {
                                            echo "<div class='my-1 mx-auto'  style='background-color:grey;'>".$epics['isi']."</div>";
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
if ($validation->hasError('isi') ) {
    echo "<script> $('#createbacklog').modal('show'); </script>";
}
?>
    </div>
</div>
</div>