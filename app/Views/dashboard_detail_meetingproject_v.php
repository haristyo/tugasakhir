<div id="content" class="px-4 pl-md-5 pr-md-4 pt-5 center">
    <!-- <div class="table-responsive-sm" style="width:100%"> -->
    <h1 class="text-center"> Dashboard Meeting <?=$project['nama_project'];?></h1>
<hr width="75%" color="black" style="height:5px;">
<div class="d-flex row">
        <form action="" method="get">
            <div class="input-group ml-3">
                <select class="custom-select mx-2" name="agenda">
                    <option selected value="">Semua Agenda</option>
                    <option value="Sprint Planning" <?php if ($agenda=="Sprint Planning") {echo "selected='selected'";}?>>Sprint Planning</option>
                    <option value="Daily Scrum" <?php if ($agenda=="Daily Scrum") {echo "selected='selected'";}?>>Daily Scrum</option>
                    <option value="Sprint Review" <?php if ($agenda=="Sprint Review") {echo "selected='selected'";}?>>Sprint Review</option>
                    <option value="Sprint Retrospective" <?php if ($agenda=="Sprint Retrospective") {echo "selected='selected'";}?>>Sprint Retrospective</option>
                </select>
                <input type="date" class="form-control "  name="tanggal" value="<?= $tanggal?>">
                <button class="btn btn-secondary" type="submit">Cari</button>
                
            </div>
        </form>    
        <div class="ml-auto mr-3 right"><?= $pager->links('meeting','pagers') ;?></div>
      </div>
<a class="btn btn-success my-2" href="<?= base_url('dashboard/proyek/'.$project['id_project']);?>">Kembali Ke detail Proyek</a>
    <table class="table table-dark" style="text-align:center">
          <thead>
            <tr>
            <th scope="col">No.</th>
              <th scope="col">Nama Proyek</th>
              <th scope="col">Agenda</th>
              <th scope="col">Waktu Meeting</th>
              <!-- <th scope="col">Tautan Meeting</th> --><!-- <td><?php //echo $meetings['link_meeting'];?></td> -->
              <th scope="col">Aksi</th>
            </tr>
          </thead>
          <tbody>
          <?php  $i=0; foreach ($meeting as $meetings) { $i++;?>
            <tr>
              <th scope="row"><?=$i;?></th>
              <td><?=$meetings['nama_project'];?></td>
              <td><?=$meetings['agenda'];?></td>
              <td><?=date('d F Y H:i', strtotime($meetings['time_meeting']));?></td>
              
              <td>
                <form action="/admin/deleteMeeting/<?=$meetings['id_meeting'].'/'.$meetings['id_project'];?>" method="post">
                    <?= csrf_field();?>
                    <button type="submit" class="btn btn-danger mx-auto">Hapus Meeting</button>
                </form>      
              </td>
            </tr>
            <?php }?>
          </tbody>
        </table>
    </div>
    </div>
</div>