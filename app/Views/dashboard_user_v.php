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
        </form>  
                <form action="<?php echo base_url('admin/exportUser')?>" method="post">
                    <?= csrf_field();?>
                    <button type="submit" class="btn btn-success ml-2 py-2">Export Data User</button>
                </form>
                
            </div>
         
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
              <th scope="col" colspan=2>Aksi</th>
            </tr>
          </thead>
          <tbody>
          <?php  if($page) {$i = (25*($page - 1) );} else {$i=0;} foreach ($users as $userss) { $i++;?>
            <tr>
              <th scope="row"><?=$i;?></th>
              <td><?=$userss['username'];?></td>
              <td><?=$userss['nama_user'];?></td>
              <td class="text-center">
              <img src="<?= base_url('/img/profil/'.$userss['foto_profile']) ?>"  style="border-radius:10%; max-height:50px;"  alt="<?= $userss['foto_profile'];?>">
              
                
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
                <?php if($userss['is_admin']=="N"  ) {?>
                  <!-- Button trigger modal -->
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#detail<?= $userss['id_user']?>">
                    Detail
                  </button>

                  <!-- Modal -->
                  <div class="modal fade" id="detail<?= $userss['id_user']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLongTitle"><?= $userss['username']?></h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                        <table class="table table-dark">
                          <thead>
                            <tr align=center valign=middle>
                              <th scope="col">No.</th>
                              <th scope="col">Nama Proyek</th>
                              <th scope="col">Posisi</th>
                              <th scope="col">Tanggal Bergabung</th>
                              <th scope="col">Backlog Dibuat</th>
                              <th scope="col">Epic Dibuat</th>
                            </tr>
                          </thead>
                          <tbody>
                          <?php $i= 0; foreach ($member as $members) {
                            if ($members['id_user']==$userss['id_user']) {?>
                            <tr>
                              <th scope="row"><?=++$i;?></th>
                              <td><?=$members['nama_project'];?></td>
                              <td><?=$members['position'];?></td>
                              <td><?= date('d-F-Y H:i:s', strtotime($members['created_member']));?></td>
                              <td>
                                <?php $backlog_total = 0; foreach ($backlog as $backlogs ) {
                                  
                                  if ($members['id_member']==$backlogs['creator_backlog']) {
                                    $backlog_total += $backlogs['id_backlog'];
                                  }
                                }
                                  echo $backlog_total;
                                  
                                ?>
                              </td>
                              <td>
                                <?php $epic_total = 0; foreach ($epic as $epics) {
                                  
                                  if ($members['id_member']==$epics['creator_epic']) {
                                    $epic_total += $epics['id_epic'];
                                  }
                                }
                                  echo $epic_total;
                                  
                                ?>
                              </td>
                            </tr>
                            <?php }}
                            if ($i ==0) {?>
                            <tr>
                              <td scope="row" colspan=6>Belum Bergabung Ke Proyek Manapun</td>
                            </tr>
                            <?php }
                            ?>
                          </tbody>
                        </table>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        </div>
                      </div>
                    </div>
                  </div>
                <?php }?>      
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