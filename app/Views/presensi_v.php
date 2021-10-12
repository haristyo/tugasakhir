    <div id="content" class="px-md-5 ">
    <?php if ($ishavescrummaster == null) { ?>
        <div class="mx-auto w-75 section-title text-center">
            <div class="mt-2 alert alert-danger" role="alert">
            <i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Anda tidak memiliki Scrum master, hubungi <a href="mailto:scrum.tool55@gmail.com">scrum.tool55@gmail.com</a> untuk mengganti Scrum master baru
            </div>  
        </div>
    <?php }?>
    <?php if ($incomingmeeting != null) {?>
        <div class="section-title text-center">
            <div class=" w-75 mt-2 mx-auto alert alert-warning" role="alert">
            <i class="fa fa-clock-o" aria-hidden="true"></i> Anda memiliki meeting hari ini pada <?php echo date('H:i:s',strtotime($incomingmeeting['time_meeting'])); ?>
            </div>  
        </div>
    <?php }?>

      <h1 class="text-center"> Presensi <?=$project['nama_project'];?></h1>
      <hr width="75%" color="black" style="height:3px;">
        <table class="table text-center table-dark">
          <thead>
            <tr class="">
              <th scope="col"></th>
              <th scope="col">Nama Pengguna</th>
              <th scope="col">Nama Lengkap</th>
              <th scope="col">Posisi</th>
              <th scope="col"> Kehadiran </th>
              
            </tr>
          </thead>
          <tbody>
          <?php  $i=0; foreach ($members as $members) { $i++;?>
            <tr>
              <th scope="row"><?=$i;?></th>
              <td><?=$members['username'];?></td>
              <td><?=$members['nama_user'];?></td>
              <td><?=$members['position'];?></td>
              <td> 
              <!-- Button trigger modal -->
              <div class=" d-flex w-100 mx-auto">
                  <button type="button" class="btn btn-success mx-auto" data-toggle="modal" data-target="#exampleModal<?=$members['id_member'];?>" clicked="clicked">
                  <?php $x = 0;
                foreach ($presensi as $presensis) {
                  if ($presensis['id_member'] == $members['id_member']) {
                    $x += $presensis['banyaknya'];
                  }
                }
                echo $x;
                ?>
                Kehadiran dari
                <?php if ($members['position']=="Product Owner") {
                    
                    echo $meetingex['id_meeting'];
                }
                else {
                    echo $meetingall['id_meeting'];
                } ?>
                pertemuan
                  </button>
                </div>
              <!-- end Button trigger modal -->
              <!-- Modal -->
              <div class="modal fade" id="exampleModal<?=$members['id_member'];?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-lg modal-dialog-centered">
                      <div class="modal-content">
                          <div class="modal-header d-flex">
                              <h5 class="modal-title mr-auto" id="exampleModalLabel"><?=$members['username'];?></h5>
                              <form action="/proyek/deletemember/<?=$members['id_project'];?>/<?=$members['id_member'];?>/" method="post">
                              <?= csrf_field();?>
                              <?php if ($member['position'] == "Scrum Master" && $member['id_user'] != $members['id_user']) {?>
                              <button type="submit" class="btn btn-danger ml-auto mr-0">Keluarkan</button>
                              <?php ;} ?>
                              </form>
                              <button type="button" class="ml-0 close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                              </button>
                          </div>
                          <div class="modal-body">
                          <table class="table text-center table-dark" >
                            <thead>
                                <tr>
                                    <th scope="col"></th>
                                    <th scope="col">Tanggal Meeting</th>
                                    <th scope="col">Jam Meeting</th>
                                    <th scope="col">Agenda</th>
                                    <th scope="col">Status Kehadiran</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php  $y=0; 
                            if ($members['position'] != "Development Team" && $members['position'] != "Scrum Master" )
                            {$meeting = $meetingexcept;}
                            else
                            {$meeting = $meetingsemua;}

                            
                            foreach ($meeting as $meetings) { $y++;?>
                                <tr>
                                <th scope="row"><?=$y; $members['position'];?></th>
                                <td><?=date("d F Y", strtotime($meetings['time_meeting']));?></td>
                                <td><?=date("H:i:s", strtotime($meetings['time_meeting']));?></td>
                                <td><?=$meetings['agenda'];?></td>
                                <td> 
                                <?php
                                foreach ($presensiall as $presensialls) {
                                  if ($presensialls['id_user']==$members['id_user'] && $presensialls['id_meeting']==$meetings['id_meeting'] ) {
                                    echo "Hadir";
                                  }
                                }
                                
                                ?>
                                </td>
                            <?php }?>
                                </tr>
                            </tbody>
                            </table>
                              
                          
                              <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                  
                              </form>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
              <!-- end modal -->
             </td>
            </tr>
            <?php }?>
          </tbody>
        </table>



    </div>
</div>