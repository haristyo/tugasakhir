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
              <td>Keluarkan</td>
            </tr>
            <?php }?>
          </tbody>
        </table>



    </div>
</div>