    <div id="content" class="px-4 pl-md-5 pr-md-4 pt-5 center">
    <!-- <div class="table-responsive-sm" style="width:100%"> -->
    <h1 class="text-center"> Dashboard Member</h1>
<hr width="75%" color="black" style="height:5px;">
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
          <?php  $i=0; foreach ($member as $members) { $i++;?>
            <tr>
              <th scope="row"><?=$i;?></th>
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
                <a href="<?= base_url('dashboard/member/'.$members['id_project'])?>" class="btn btn-primary">Detail</a>
              </td>
            </tr>
            <?php }?>
          </tbody>
        </table>
    <!-- </div> -->
    </div>
</div>