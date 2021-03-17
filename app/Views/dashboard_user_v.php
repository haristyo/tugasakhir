    <div id="content" class="px-4 pl-md-5 pr-md-4 pt-5 center">
    <!-- <div class="table-responsive-sm" style="width:100%"> -->
    <h1 class="text-center"> Dashboard User</h1>
<hr width="75%" color="black" style="height:5px;">
    <table class="table table-dark">
          <thead>
            <tr>
              <th scope="col">No.</th>
              <th scope="col">Username</th>
              <th scope="col">nama_user</th>
              <th scope="col">foto_profile</th>
              <th scope="col">Email</th>
              <th scope="col">Status Admin</th>
              <th scope="col">Aksi</th>
            </tr>
          </thead>
          <tbody>
          <?php  $i=0; foreach ($users as $userss) { $i++;?>
            <tr>
              <th scope="row"><?=$i;?></th>
              <td><?=$userss['username'];?></td>
              <td><?=$userss['nama_user'];?></td>
              <td class="text-center">
              <img src="<?= base_url('/img/profil/'.$userss['foto_profile']) ?>"  style="border-radius:10%; max-height:50px;"  alt=<?= $userss['foto_profile'];?>">
              
                
              </td>
              <td><?=$userss['email'];?></td>
              <td>
                <?php if ($userss['is_admin']=="N") {
                  echo "Tidak";
                }else {
                  echo "Ya";
                } ?>
              </td>
              <td>
                <?php if ($userss['is_admin']=="N") {?>
                <form action="/admin/deleteUser/<?=$userss['id_user'];?>" method="post">
                    <?= csrf_field();?>
                    <button type="submit" class="btn btn-danger ml-auto mr-0">Hapus User</button>
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