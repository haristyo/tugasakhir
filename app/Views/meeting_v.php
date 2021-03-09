<div id="content" class="p-4 p-md-5 pt-5">
    <!-- Button trigger modal -->
    <div class=" d-flex w-100 mx-auto my-2">
        <button type="button" class="btn btn-success mr-0 ml-auto" data-toggle="modal" data-target="#exampleModal" clicked="clicked">
    Tambah Meeting
    </button>
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
                            <input type="text" class="form-control <?php if ($validation->hasError('link_meeting')) {echo 'is-invalid';} elseif(session()->getFlashData('link_meeting')) {echo 'is-invalid';} ;?>" id="link_meeting" name="link_meeting"  value="<?=old('link_meeting')?>">
                            <!-- <small id="emailHelp" class="form-text text-muted">enter your email or username</small> -->
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
    <!-- end modal
     -->
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
        </tr>
    </thead>
    <tbody>
    <?php  $i=0; foreach ($meetings as $meetings) { $i++;?>
        <tr>
        <th scope="row"><?=$i;?></th>
        <td><?=date("d F Y", strtotime($meetings['time_meeting']));?></td>
        <td><?=date("H:i:s", strtotime($meetings['time_meeting']));?></td>
        <td><?=$meetings['agenda'];?></td>
        <td><?=$meetings['deskripsi_meeting'];?></td>
        <td>
            <form action="/proyek/meetingjoin/<?=$meetings['id_meeting'];?>" method="post" target="_blank">
            <?= csrf_field()?>
            <button type="submit" class="btn btn-success" >Gabung</button>
            </form>
        </td>
        <td>
        <?php
        foreach ($yanghadir as $yanghadirs) {
            if($yanghadirs['id_meeting']==$meetings['id_meeting']) 
            echo $yanghadirs['banyaknya'];
            // if ($yanghadir['id_meeting']==1) {
            // }
        }
        ?>
        Kehadiran dari
        <?php if ($meetings['agenda']=="Sprint Planning" || $meetings['agenda'] == "Sprint Review") {
            echo $countall['id_member'];
        }
        else {
            echo $countex['id_member'];
        } ?>
        </td>
        <?php }?>
        </tr>
    </tbody>
    </table>
</div>
</div>
<?php //jika salah auto membuka model kembali
if ($validation->hasError('link_meeting') || $validation->hasError('time_meeting') || $validation->hasError('agenda')) {
    echo "<script> $('#exampleModal').modal('show'); </script>";
}
?>