<div id="content" class="px-4 pl-md-5 pr-md-4 pt-5 center">
    <!-- <div class="table-responsive-sm" style="width:100%"> -->
    <h1 class="text-center"> Dashboard User</h1>
    <hr width="75%" color="black" style="height:5px;">
      <div class="d-flex row">
        <form action="" method="get">
            <div class="input-group ml-3">
                <input type="text" class="form-control"  name="search" value="<?= $keyword?>">
                <select class="custom-select mx-2" name="status">
                    <option selected value="">Semua Status</option>
                    <option value="admin" <?php if ($status=="admin") {echo "selected='selected'";}?>>Admin</option>
                    <option value="bukanadmin" <?php if ($status=="bukanadmin") {echo "selected='selected'";}?>>Bukan Admin</option>

                </select>
                
                <button class="btn btn-secondary" type="submit">Cari</button>
                
            </div>
        </form>    
        <div class="ml-auto mr-3 right"><?= $pager->links('user','pagers') ;?></div>
      </div>


    <table class="table table-dark">
          <thead>
            <tr style="text-align:center">
              <th scope="col">No.</th>
              <th scope="col">Nama Pengguna</th>
              <th scope="col">Nama Lengkap</th>
              <th scope="col">Foto Profil</th>
              <th scope="col">Email</th>
              <th scope="col">Status Admin</th>
              <th scope="col">Aksi</th>
            </tr>
          </thead>
          <tbody>
          <?php  if($page) {$i = (25*($page - 1) );} else {$i=0;} foreach ($users as $userss) { $i++;?>
            <tr>
              <th scope="row"><?=$i;?></th>
              <td><?=$userss['username'];?></td>
              <td><?=$userss['nama_user'];?></td>
              <td class="text-center">
              <img src="<?= base_url('/img/profil/'.$userss['foto_profile']) ?>"  style="border-radius:10%; max-height:50px;"  alt=<?= $userss['foto_profile'];?>">
              
                
              </td>
              <td><?=$userss['email'];?></td>
              <td style="text-align:center">
                <?php if ($userss['is_admin']=="N") {
                  echo "Tidak";
                }else {
                  echo "Ya";
                } ?>
              </td>
              <td style="text-align:center">
                <?php if($user['is_admin']=="S"  && $userss['is_admin']!="S" || ( $user['is_admin']=="Y" && $userss['is_admin']=="N") ) {?>
                <form action="/admin/deleteUser/<?=$userss['id_user'];?>" method="post">
                    <?= csrf_field();?>
                    <button type="submit" class="btn btn-danger ml-auto mr-0">Hapus</button>
                </form>
                <?php }?>      
              </td>
            </tr>
            <?php }?>
          </tbody>
        </table>
    <!-- </div> -->
    </div>
</div>