    <div id="content" class="px-md-5 pt-5">
        
        
        <h1 class="text-center"> <?=$member['nama_project'];?></h1>
    <hr width="75%" color="black" style="height:5px;">
    <!-- <h2> -->
        <h3 class="text-center"> <?=$member['deskripsi'];?></h3>
        <table class="table table-dark">
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
              <td><?=$members['created_member'];?></td>
            </tr>
            <?php }?>
          </tbody>
        </table>



    </div>
</div>