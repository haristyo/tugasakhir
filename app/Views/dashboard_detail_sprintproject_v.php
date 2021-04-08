<div id="content" class="px-4 pl-md-5 pr-md-4 pt-5 center">
    <!-- <div class="table-responsive-sm" style="width:100%"> -->
    <h1 class="text-center"> Dashboard Meeting <?=$project['nama_project'];?></h1>
<hr width="75%" color="black" style="height:5px;">
<div class="d-flex row">
        <form action="" method="get">
            <div class="input-group ml-3">
                <input type="text" class="form-control mr-2"  name="search" value="<?= $keyword?>" placeholder="cari..">
                <input type="date" class="form-control "  name="tanggal" value="<?= $tanggal?>">
                <button class="btn btn-secondary" type="submit">Cari</button>
            </div>
        </form>    
        <div class="ml-auto mr-3 right"><?= $pager->links('sprint','pagers') ;?></div>
      </div>
<a class="btn btn-success my-2" href="<?= base_url('dashboard/proyek/'.$project['id_project']);?>">Kembali Ke detail Proyek</a>
    <table class="table table-dark" style="text-align:center">
          <thead>
            <tr>
            <th scope="col">No.</th>
              <th scope="col">Sprint Goal</th>
              <th scope="col">Start Sprint</th>
              <th scope="col">End Sprint</th>
              <!-- <th scope="col">Tautan Meeting</th> --><!-- <td><?php //echo $meetings['link_meeting'];?></td> -->
              <th scope="col" colspan="2">Aksi</th>
            </tr>
          </thead>
          <tbody>
          <?php  if($page) {$i = (25*($page - 1));} else {$i=0;} foreach ($sprint as $sprints) { $i++;?>
            <tr>
              <th scope="row"><?=$i;?></th>
              <td><?=$sprints['goal'];?></td>
              <td><?=date('d-F-Y H:i:s', strtotime($sprints['start_sprint']));?></td>
              <td><?php if($sprints['end_sprint']!=null) {echo date('d-F-Y H:i:s', strtotime($sprints['end_sprint']));} else {
                echo "<div class=' m-auto' style='background-color: #28a745;padding: 0.375rem 0.75rem;
                font-size: 1rem;
                line-height: 1.5;
                border-radius: 0.25rem;'> Masih Berjalan</div>";
              }?></td>
              <?php if($sprints['end_sprint']!=null) {?>
              <td>
                <form action="/admin/reactivationSprint/<?=$sprints['id_sprint'].'/'.$sprints['id_project'];?>" method="post">
                    <?= csrf_field();?>
                    <button type="submit" class="btn btn-warning mx-auto w-100">Aktifkan Sprint Kembali</button>
                </form>      
              </td>
              <?php }elseif($sprints['end_sprint']==null) {?>
              <td>
                <form action="/admin/endsprint/<?=$sprints['id_sprint'].'/'.$sprints['id_project'];?>" method="post">
                    <?= csrf_field();?>
                    <button type="submit" class="btn btn-warning mx-auto w-100" >Akhiri Sprint</button>
                </form>      
              </td>
              <?php }?>
              <td>
                <form action="/admin/deletesprint/<?=$sprints['id_sprint'].'/'.$sprints['id_project'];?>" method="post">
                    <?= csrf_field();?>
                    <button type="submit" class="btn btn-danger mx-auto w-100">Hapus Sprint</button>
                </form>      
              </td>
            </tr>
            <?php }?>
          </tbody>
        </table>
    </div>
    </div>
</div>