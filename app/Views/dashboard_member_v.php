    <div id="content" class="px-4 pl-md-5 pr-md-4 pt-5 center">
    <!-- <div class="table-responsive-sm" style="width:100%"> -->
    <h1 class="text-center"> Dashboard Member</h1>
<hr width="75%" color="black" style="height:5px;">
    <div class="d-flex row">
      <form action="" method="get">
        <div class="input-group ml-3">
          <input type="text" class="form-control" placeholder="Cari..." name="search" value="<?= $keyword?>">
          <div class="input-group-append">
            <button class="btn btn-secondary" type="submit" >Cari</button>
          </div>
        </div>
      </form>    
        <div class="ml-auto mr-0 right"><?= $pager->links('member','pagers') ;?></div>
    </div>

    <table class="table table-dark">
          <thead>
            <tr>
              <th scope="col">No.</th>
              <th scope="col">Nama User</th>
              <th scope="col">Nama Lengkap</th>
              <th scope="col">Nama Proyek</th>
              <th scope="col">Posisi</th>
              <th scope="col">Email</th>
              <th scope="col">Tanggal Gabung</th>
              <th scope="col">Status</th>
              <th scope="col" colspan="3" class="text-center"> Aksi</th>
            </tr>
          </thead>
          <tbody>
          <?php  if($page) {$i = (25*($page - 1) + 1);} else {$i=1;} foreach ($member as $members) {?>
            <tr>
              <th scope="row"><?=$i++;?></th>
              <td><?=$members['username'];?></td>
              <td><?=$members['nama_user'];?></td>
              <td><?=$members['nama_project'];?></td>
              <td><?=$members['position'];?></td>
              <td><?=$members['email'];?></td>
              <td><?= date('d-F-Y H:i:s', strtotime($members['created_member']));?></td>
              <td><?php if ($members['left_at'] != null) {
                # code...
               echo "Keluar pada <br>".date('d-F-Y H:i:s', strtotime($members['left_at']));
              } else {
                echo 'Aktif';
              } ?></td>
            <td>
                <form action="/admin/toScrumMaster/<?=$members['id_member'];?>" method="post">
                    <?= csrf_field();?>
                    <button type="submit" class="btn btn-warning ml-auto mr-0">Ubah Menjadi Scrum master</button>
                </form>      
            </td>
              <td>
                <form action="/admin/toDevelopmentTeam/<?=$members['id_member'];?>" method="post">
                    <?= csrf_field();?>
                    <button type="submit" class="btn btn-danger ml-auto mr-0">Ubah Menjadi Development Team</button>
                </form>      
            </td>
            <td>
                  <form action="/admin/reactivation/<?=$members['id_member'];?>" method="post">
                      <?= csrf_field();?>
                      <button type="submit" class="btn btn-secondary ml-auto mr-0">Aktivasi kembali</button>
                  </form>      
              </td>
            </tr>
            <?php }?>
          </tbody>
        </table>
    <!-- </div> -->
    </div>
</div>