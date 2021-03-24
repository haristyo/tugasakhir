<div id="content" class="p-4 p-md-5 pt-5">
    <h1 class="text-center"> Meeting </h1>
      <hr width="75%" color="black" style="height:3px;">

      <?php if ($member['position'] == "Scrum Master") {?>
    <!-- Button trigger modal -->
    <div class=" d-flex w-100 mx-auto my-2">
        <button type="button" class="btn btn-success mr-0 ml-auto mb-2" data-toggle="modal" data-target="#exampleModal" clicked="clicked">
    Tambah Meeting
    </button>
    </div>
    <!-- end Button trigger modal -->
    <?php ;}?>

      <div class="d-flex row">
        <form action="" method="get">
            <div class="input-group ml-3">
                <input type="text" class="form-control "  name="search" value="<?= $keyword?>">
                <select class="custom-select mx-2" name="agenda">
                    <option selected value="">Semua Agenda</option>
                    <option value="Sprint Planning" <?php if ($agenda=="Sprint Planning") {echo "selected='selected'";}?>>Sprint Planning</option>
                    <option value="Daily Scrum" <?php if ($agenda=="Daily Scrum") {echo "selected='selected'";}?>>Daily Scrum</option>
                    <option value="Sprint Review" <?php if ($agenda=="Sprint Review") {echo "selected='selected'";}?>>Sprint Review</option>
                    <option value="Sprint Retrospective" <?php if ($agenda=="Sprint Retrospective") {echo "selected='selected'";}?>>Sprint Retrospective</option>
                </select>
                
                <button class="btn btn-secondary" type="submit">Cari</button>
                
            </div>
        </form>    
        <div class="ml-auto mr-3 right"><?= $pager->links('meeting','pagers') ;?></div>
      </div>
    
    

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Meeting</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="" method="post" action="/proyek/createmeeting/<?=$member['id_project'];?>">
                        <?= csrf_field(); ?>
                        <div class="form-group">
                            <label for="agenda">Agenda</label>
                            <select class="custom-select <?= ($validation->hasError('agenda')) ? 'is-invalid' : '' ;?>" name="agenda">
                                <option selected>Pilih Agenda</option>
                                <option value="Sprint Planning" <?php if (old('agenda')=="Sprint Planning") {echo "selected='selected'";}?>>Sprint Planning</option>
                                <option value="Daily Scrum" <?php if (old('agenda')=="Daily Scrum") {echo "selected='selected'";}?>>Daily Scrum</option>
                                <option value="Sprint Review" <?php if (old('agenda')=="Sprint Review") {echo "selected='selected'";}?>>Sprint Review</option>
                                <option value="Sprint Retrospective" <?php if (old('agenda')=="Sprint Retrospective") {echo "selected='selected'";}?>>Sprint Retrospective</option>
                            </select>
                            <div class="invalid-feedback">
                                <?=$validation->getError('agenda');?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="deskripsi_meeting">Deskripsi</label>
                            <textarea class="form-control" id="deskripsi_meeting" name="deskripsi_meeting"><?=old('deskripsi_meeting')?></textarea>
                            <!-- <small id="emailHelp" class="form-text text-muted">enter your email or username</small> -->
                        </div>

                        <div class="form-group">
                            <label for="link_meeting">Tautan</label>
                            <input type="text" class="form-control <?php if ($validation->hasError('link_meeting')) {echo 'is-invalid';} elseif(session()->getFlashData('link_meeting')) {echo 'is-invalid';} ;?>" id="link_meeting" name="link_meeting"  value="<?=old('link_meeting')?>"
                            placeholder="ex: https://zoom.com / https://meet.google.com">
                            <small  class="form-text text-muted">Masukkan tautan beserta protokolnya contoh:(http://,https://)</small>
                            <div class="invalid-feedback">
                                <?=$validation->getError('link_meeting');?>
                                <?=session()->getFlashData('link_meeting');?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="time_meeting">Waktu</label>
                            <input id="time_meeting" type="datetime-local" class="form-control <?php if ($validation->hasError('time_meeting')) {echo 'is-invalid';} elseif(session()->getFlashData('time_meeting')) {echo 'is-invalid';} ;?>" id="time_meeting" name="time_meeting"  value="<?=old('time_meeting')?>">
                            <!-- <small id="emailHelp" class="form-text text-muted">enter your email or username</small> -->
                            <div class="invalid-feedback">
                                <?=$validation->getError('time_meeting');?>
                                <?=session()->getFlashData('time_meeting');?>
                            </div>
                        </div>
                    
                
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Tambah Meeting</button>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end modal-->
    <table class="table text-center table-dark" >
    <thead>
        <tr>
            <th scope="col"></th>
            <th scope="col">Tanggal Meeting</th>
            <th scope="col">Jam Meeting</th>
            <th scope="col">Agenda</th>
            <th scope="col">Deskripsi</th>
            <th scope="col">Join</th>
            <th scope="col">Kehadiran</th>
            <?php if($member['position'] == "Scrum Master") {?>
            <th scope="col">Aksi</th>
            <?php }?>
        </tr>
    </thead>
    <tbody>
    <?php  $i=0; foreach ($meetings as $meetings) { $i++;?>
        <tr>
        <th scope="row"><?=$i;?></th>
        <td><?=date("d F Y", strtotime($meetings['time_meeting']));?></td>
        <td><?=date("H:i", strtotime($meetings['time_meeting']));?></td>
        <td><?=$meetings['agenda'];?></td>
        <td><?=$meetings['deskripsi_meeting'];?></td>
        <td>
            <form action="/proyek/meetingjoin/<?=$meetings['id_meeting'];?>" method="post" target="_blank">
            <?= csrf_field();?>
            <button type="submit" class="btn btn-success"
            <?php if( (time() > (strtotime($meetings['time_meeting']) - 360)) && (time() < (strtotime($meetings['time_meeting']) + 360)) ) {} else {echo "disabled";}?>
            >
            Gabung</button>
            </form>
           

        </td>
        <td>

            <!-- Button trigger modal -->
            <div class=" d-flex w-100 mx-auto ">
                  <button type="button" class="btn btn-success mr-0 ml-auto w-100" data-toggle="modal" data-target="#exampleModal<?=$meetings['id_meeting'];?>" clicked="clicked">
                    <?php
                        $kehadiran = 0;
                        foreach ($yanghadir as $yanghadirs) {
                            if($yanghadirs['id_meeting']==$meetings['id_meeting']) 
                            {$kehadiran += $yanghadirs['banyaknya'];} 
                        }
                        echo $kehadiran;
                        ?>
                    Kehadiran dari
                        <?php if ($meetings['agenda']=="Sprint Planning" || $meetings['agenda'] == "Sprint Review") {
                            echo $countall['id_member'];
                        }
                        else {
                            echo $countex['id_member'];
                        } ?>
                    anggota
                  </button>
                  
                </div>
              <!-- end Button trigger modal -->
              <!-- Modal -->
              <div class="modal fade" id="exampleModal<?=$meetings['id_meeting'];?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-lg">
                      <div class="modal-content">
                          <div class="modal-header d-flex">
                              <h5 class="modal-title mr-auto" id="exampleModalLabel"><?=$meetings['agenda'].' '.date("d-F-Y", strtotime($meetings['time_meeting'])).' '.date("H:i", strtotime($meetings['time_meeting']));?></h5>
                                <?php if ($member['position'] == "Scrum Master" ) {?>
                                    <form action="/proyek/deleteMeeting/<?=$meetings['id_project'];?>/<?=$meetings['id_meeting'];?>/" method="post">
                                    <?= csrf_field();?>
                                    <button type="submit" class="btn btn-danger ml-auto mr-0" <?php if (time() > (strtotime($meetings['time_meeting']) + 86400)) {
                                        echo "disabled";
                                    } ?>>Hapus Meeting</button>
                                    </form>
                                <?php ;} ?>
                              <button type="button" class="ml-0 close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                              </button>
                          </div>
                          <div class="modal-body">
                          <table class="table text-center table-dark" >
                            <thead>
                                <tr>
                                    <th scope="col"></th>
                                    <th scope="col">Username</th>
                                    <th scope="col">Posisi</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php  $y=0; 

                            foreach ($members as $memberss) { $y++;?>
                                <tr>
                                <th scope="row"><?=$y;?></th>
                                <td><?= $memberss['username'];?></td>
                                <td><?= $memberss['position'];?></td>
                                <td> 
                                <?php
                                foreach ($presensiall as $presensialls ) {
                                  if ($presensialls['id_user']==$memberss['id_user'] && $presensialls['id_meeting']==$meetings['id_meeting']) {
                                    echo "hadir";
                                  }
                                }
                                
                                ?>
                                </td>
                            <?php }?>
                                </tr>
                            </tbody>
                            </table>
                              
                          
                              <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                  
                              </form>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
              <!-- end modal -->

        </td>
        <?php if($member['position'] == "Scrum Master") {?>
        <td>
            <!-- Button trigger modal -->
                <div class=" d-flex w-100 mx-auto">
                    <button type="button" class="btn btn-warning mr-0 ml-auto mb-2" data-toggle="modal" data-target="#edit<?=$meetings['id_meeting'];?>" clicked="clicked">
                        Ubah Meeting
                </button>
                </div>
                <!-- end Button trigger modal -->
                <!-- Modal -->
                <div class="modal fade" id="edit<?=$meetings['id_meeting'];?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Ubah Meeting</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form class="" method="post" action="/proyek/editmeeting/<?=$meetings['id_project'].'/'.$meetings['id_meeting'];?>">
                                <?= csrf_field(); ?>
                                <div class="form-group">
                                    <label for="agenda<?=$meetings['id_meeting'];?>" class="text-left" style="float: left; color:black;">Agenda  </label>
                                    <select class="custom-select <?= ($validation->hasError('agenda'.$meetings['id_meeting'])) ? 'is-invalid' : '' ;?>" name="agenda<?=$meetings['id_meeting'];?>">
                                        <option selected>Pilih Agenda</option>
                                        <option value="Sprint Planning" <?php if ($meetings['agenda'] == 'Sprint Planning') {echo "selected='selected'";}?>>Sprint Planning</option>
                                        <option value="Daily Scrum" <?php if ($meetings['agenda']=="Daily Scrum") {echo "selected='selected'";}?>>Daily Scrum</option>
                                        <option value="Sprint Review" <?php if ($meetings['agenda']=="Sprint Review") {echo "selected='selected'";}?>>Sprint Review</option>
                                        <option value="Sprint Retrospective" <?php if ($meetings['agenda']=="Sprint Retrospective") {echo "selected='selected'";}?>>Sprint Retrospective</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        <?=$validation->getError('agenda'.$meetings['id_meeting']);?>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="deskripsi_meeting" style="float: left; color:black;">Deskripsi</label>
                                    <textarea class="form-control" id="deskripsi_meeting" name="deskripsi_meeting<?=$meetings['id_meeting'];?>"> <?=$meetings['deskripsi_meeting'];?></textarea>
                                    <!-- <small id="emailHelp" class="form-text text-muted">enter your email or username</small> -->
                                </div>

                                <div class="form-group">
                                    <label for="link_meeting" style="float: left; color:black;">Tautan</label>
                                    <input type="text" class="form-control <?php if ($validation->hasError('link_meeting'.$meetings['id_meeting'])) {echo 'is-invalid';} elseif(session()->getFlashData('link_meeting'.$meetings['id_meeting'])) {echo 'is-invalid';} ;?>" id="link_meeting<?=$meetings['id_meeting'];?>" name="link_meeting<?=$meetings['id_meeting'];?>"  value="<?=$meetings['link_meeting'];?>"
                                    placeholder="ex: https://zoom.com / https://meet.google.com">
                                    <small  class="form-text text-muted" style="float: left;">Masukkan tautan beserta protokolnya contoh:(http://,https://)</small>
                                    <br/>
                                    <div class="invalid-feedback" style="float: left;">
                                        <?=$validation->getError('link_meeting'.$meetings['id_meeting']);?>
                                        
                                    </div>
                                </div>
                                <br/>
                                <div class="form-group">
                                    <label for="time_meeting<?=$meetings['id_meeting'];?>" style="float: left; color:black;"> Waktu</label>
                                    <input  id="time_meeting<?=$meetings['id_meeting'];?>" type="datetime-local" class="form-control <?php if ($validation->hasError('time_meeting'.$meetings['id_meeting'])) {echo 'is-invalid';} elseif(session()->getFlashData('time_meeting'.$meetings['id_meeting'])) {echo 'is-invalid';} ;?>"  name="time_meeting<?=$meetings['id_meeting'];?>"  value="<?=date("Y-m-d", strtotime($meetings['time_meeting'])).'T'.date("H:i", strtotime($meetings['time_meeting']))?>">
                                    <!-- <small id="emailHelp" class="form-text text-muted">enter your email or username</small> -->
                                    <div class="invalid-feedback">
                                        <?=$validation->getError('time_meeting'.$meetings['id_meeting']);?>
                                        <?=session()->getFlashData('time_meeting'.$meetings['id_meeting']);?>
                                    </div>
                                </div>
                            
                        
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success">Ubah Meeting</button>
                            </form>
                        </div>
                    </div>
                </div>
                </div>
            <!-- end modal-->
            

    <?php 
    if ($validation->hasError('link_meeting'.$meetings['id_meeting']) || $validation->hasError('time_meeting'.$meetings['id_meeting']) || $validation->hasError('agenda'.$meetings['id_meeting'])) { 
        echo "<script> $('#edit".$meetings['id_meeting']."').modal('show'); </script>";
         ;} ?>
    </td>
    <?php }?>
       
        
    </tr>
    <?php }?>
    </tbody>
    </table>
</div>
<?php //jika salah auto membuka model kembali
if ($validation->hasError('link_meeting') || $validation->hasError('time_meeting') || $validation->hasError('agenda')) {
    echo "<script> $('#exampleModal').modal('show'); </script>";
}
?>
</div>
