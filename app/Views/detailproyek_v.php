    <div id="content" class="px-md-5 pt-5">
    
    
            
        
    <?php if ($member['position']=="Scrum Master") {?>
    
    <?php if ($incomingmeeting != null) {?>
        <div class="section-title text-center">
            <div class=" w-75 mx-auto alert alert-warning" role="alert">
            <i class="fa fa-clock-o" aria-hidden="true"></i> Anda memiliki meeting hari ini pada <?php echo date('H:i:s',strtotime($incomingmeeting['time_meeting'])); ?>
            </div>  
        </div>
    <?php }?>
    <div class="d-flex w-75 mx-auto">
          <h1 class="mr-0 ml-auto"> <?=$member['nama_project'];?> </h1>
          <h1 class="fa fa-pencil-square-o fa-2x mr-0 my-auto ml-auto" data-toggle="modal" data-target="#editproyek"></h1>
    </div>
  
          
          
                        <!-- Button trigger modal -->
                                <div class=" d-flex w-100 mx-auto">
                              </div>
                              <!-- end Button trigger modal -->
                              <!-- Modal -->
                              <div class="modal fade" id="editproyek" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog modal-dialog-centered modal-lg">
                              <div class="modal-content" style="background-color:#dcf5ef;">
                                      <div class="modal-header">
                                          <h5 class="modal-title" id="exampleModalLabel">Edit Proyek</h5>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                          </button>
                                      </div>
                                      <form class="" method="post" action="/proyek/editproyek/<?=$member['id_project'];?>">
                                      <div class="modal-body">
                                              <?= csrf_field(); ?>
                                              <div class="form-group">
                                                  <label for="nama_project">Nama Proyek</label>
                                                  <input type="text" class="form-control <?= ($validation->hasError('nama_project')) ? 'is-invalid' : '' ;?>" id="nama_project" name="nama_project" autofocus value="<?= $member['nama_project']?>">
                                                  <div class="invalid-feedback">
                                                      <?=$validation->getError('nama_project');?>
                                                  </div>
                                              </div>
                                              <div class="form-group">
                                                  <label for="deskripsi">Deskripsi</label>
                                                  <textarea class="w-100" id="deskripsi" name="deskripsi" rows="4"><?= $member['deskripsi']?></textarea>
                                                  <div class="invalid-feedback">
                                                      <?=$validation->getError('deskripsi');?>
                                                  </div>
                                              </div>
                                              <div class="form-group">
                                                  <label for="kode_join">Kode Join</label>
                                                  <input type="text" class="form-control <?= ($validation->hasError('kode_join')) ? 'is-invalid' : '' ;?>" id="kode_join" name="kode_join" value="<?= $member['kode_join']?>">
                                                  
                                                  <div class="invalid-feedback">
                                                      <?=$validation->getError('kode_join');?>
                                                  </div>
                                              </div>
                                              <div class="form-group">
                                                  <label for="password_project">Kata Sandi Proyek</label>
                                                  <input type="text" class="form-control <?= ($validation->hasError('password_project')) ? 'is-invalid' : '' ;?>" id="password_project" name="password_project" value="<?= $member['password_project']?>">
                                                  <div class="invalid-feedback">
                                                      <?=$validation->getError('password_project');?>
                                                  </div>
                                              </div>
                                      </div>
                                          <div class="modal-footer">
                                              <button type="submit" class="btn btn-success" >Ubah Proyek</button>
                                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                          </form>
                                      </div>
                                  </div>

                              </div>
                              </div>
                              <?php 
                          if ($validation->hasError('kode_join') || $validation->hasError('password_project')|| $validation->hasError('nama_project') ) { 
                            echo "<script> $('#editproyek').modal('show'); </script>";
                            ;} ?>
                        
                        <!-- end modal-->
                      <?php } else {?>

                        <div class="w-75 mx-auto">
                        <?php if ($ishavescrummaster == null) {?>
                            <div class="section-title text-center">
                                <div class="alert alert-danger" role="alert">
                                <i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Anda tidak memiliki Scrum master, hubungi <a href="mailto:scrum.tool55@gmail.com">scrum.tool55@gmail.com</a> untuk mengganti Scrum master baru
                                </div>  
                            </div>
                        <?php }?>

                        <?php if ($incomingmeeting != null) {?>
                            <div class="section-title text-center">
                                <div class="alert alert-warning" role="warning">
                                <i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Anda memiliki meeting hari ini pada <?php echo $incomingmeeting['time_meeting']; ?>
                                </div>  
                            </div>
                        <?php }?>
          <h1 class="mx-auto"> <?=$member['nama_project'];?> </h1>
    </div>

                        <?php ;}?>
          
    
    <hr width="75%" color="black" style="height:5px;">

    <div class="d-flex w-75 mx-auto">
    
        <div class="ml-0 mr-auto"><h5>Pembuat Proyek</h5></div>
        
        <div class="mr-0 ml-auto"><h5><?=$project['username'];?> (<?=$project['nama_user'];?>)</h5></div> 
    </div>
    <div class="d-flex w-75 ml-auto mr-auto">
    
        <div class="ml-0 mr-auto"><h5>Dibuat Tanggal</h5></div>
        
        <div class="mr-0 ml-auto"><h5><?=date("d F Y H:i:s", strtotime($project['created_project'])) ;?></h5></div>
        
    </div>
    <div class="d-flex w-75 ml-auto mr-auto">
    
        <div class="ml-0 mr-auto"><h5>Kode Gabung</h5></div>
        
        <div class="mr-0 ml-auto"><h5><?=$project['kode_join'];?></h5></div> 
    </div>
    <div class="d-flex w-75 ml-auto mr-auto">
    
        <div class="ml-0 mr-auto"><h5>Kata Sandi Project</h5></div>
        
        <div class="mr-0 ml-auto"><h5><?=$project['password_project'];?></h5></div> 
    </div>
    <hr width="75%" color="black" style="height:5px;">
    <!-- <h2> -->
        <h3 class="text-center w-75 mx-auto"> <?= nl2br($member['deskripsi']);?></h3>
        <table class="table table-dark w-75 mx-auto">
          <thead>
            <tr>
              <th scope="col"></th>
              <th scope="col">Nama Pengguna</th>
              <th scope="col">Nama Lengkap</th>
              <th scope="col">Posisi</th>
              <th scope="col">Tanggal Bergabung</th>
            </tr>
          </thead>
          <tbody>
          <?php  $i=0; foreach ($members as $members) { $i++;?>
            <tr>
              <th scope="row"><?=$i;?></th>
              <td><?=$members['username'];?></td>
              <td><?=$members['nama_user'];?></td>
              <td><?=$members['position'];?></td>
              <td><?=date("d F Y H:i:s", strtotime($members['created_member'])) ;?></td>
              
            </tr>
            <?php }?>
          </tbody>
        </table>



    </div>
</div>