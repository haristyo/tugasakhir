    <div id="content" class="p-4 p-md-5 pt-5">

        <table class="table table-dark">
          <thead>
            <tr>
              <th scope="col"></th>
              <th scope="col">Nama Pengguna</th>
              <th scope="col">Nama Lengkap</th>
              <th scope="col">Posisi</th>
              <th> Kehadiran </th>
              <th scope="col">Aksi</th>
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
              </td>
              <td> 
              <!-- Button trigger modal -->
              <div class=" d-flex w-100 mx-auto my-2">
                  <button type="button" class="btn btn-success mr-0 ml-auto" data-toggle="modal" data-target="#exampleModal<?=$members['id_member'];?>" clicked="clicked">
                  Detail
                  </button>
                </div>
              <!-- end Button trigger modal -->
              <!-- Modal -->
              <div class="modal fade" id="exampleModal<?=$members['id_member'];?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-lg">
                      <div class="modal-content">
                          <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel"><?=$members['username'];?></h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
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
                                    <th scope="col">Join</th>
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
                                    echo "hadir";
                                  }
                                }
                                
                                ?>
                                </td>
                            <?php }?>
                                </tr>
                            </tbody>
                            </table>
                              
                          
                              <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                  
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