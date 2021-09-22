    <div id="content" class="p-4 p-md-5 pt-5">
    <h1 class="text-center"> Dashboard Proyek</h1>
<hr width="75%" color="black" style="height:5px;">
      <div class="d-flex row">
        <form action="" method="get">
          <div class="input-group ml-3">
          <input type="text" class="form-control" placeholder="Cari..." name="search" value="<?= $keyword?>">
          <div class="input-group-append">
            <button class="btn btn-secondary" type="submit">Cari</button>
          </div>
        </div>
        </form>    
        <div class="ml-auto mr-0 right"><?= $pager->links('project','pagers') ;?></div>
      </div>
    <table class="table table-dark">
          <thead>
            <tr align=center valign=middle>
              <th scope="col">No.</th>
              <th scope="col">Nama Proyek</th>
              <th scope="col">Deskripsi</th>
              <th scope="col">Kode Proyek</th>
              <th scope="col">Kata Sandi Proyek</th>
              <th scope="col">Tanggal Pembuatan</th>
              <th scope="col">Nama Pengguna Pembuat Proyek</th>
              <th scope="col"></th>
            </tr>
          </thead>
          <tbody>
          <?php  if($page) {$i = (25*($page - 1) + 1);} else {$i=1;} foreach ($project as $projects) { ?>
            <tr>
              <th scope="row"><?=$i++;?></th>
              <td><?=$projects['nama_project'];?></td>
              <td><?=$projects['deskripsi'];?></td>
              <td><?=$projects['kode_join'];?></td>
              <td><?=$projects['password_project'];?></td>
              <td><?= date('d-F-Y H:i:s', strtotime($projects['created_project']));?></td>
              <td><?=$projects['username'];?></td>
              <td><a href="<?= base_url('dashboard/proyek/'.$projects['id_project'])?>" class="btn btn-primary">Detail</a></td>
            </tr>
            <?php }?>
          </tbody>
        </table>

    </div>
</div>