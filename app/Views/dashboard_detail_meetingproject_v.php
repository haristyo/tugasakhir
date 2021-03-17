<div id="content" class="px-4 pl-md-5 pr-md-4 pt-5 center">
    <!-- <div class="table-responsive-sm" style="width:100%"> -->
    <h1 class="text-center"> Dashboard Meeting</h1>
<hr width="75%" color="black" style="height:5px;">
    <table class="table table-dark">
          <thead>
            <tr>
            <th scope="col">No.</th>
              <th scope="col">Project</th>
              <th scope="col">Agenda</th>
              <th scope="col">Waktu Meeting</th>
              <th scope="col">Tautan Meeting</th>
              <th scope="col">Aksi</th>
            </tr>
          </thead>
          <tbody>
          <?php  $i=0; foreach ($meeting as $meetings) { $i++;?>
            <tr>
              <th scope="row"><?=$i;?></th>
              <td><?=$meetings['nama_project'];?></td>
              <td><?=$meetings['agenda'];?></td>
              <td><?=date('d-F-Y H:i:s', strtotime($meetings['time_meeting']));?></td>
              <td><?=$meetings['link_meeting'];?></td>
              <td>
                <form action="/admin/deleteMeeting/<?=$meetings['id_project'];?>/<?=$meetings['id_meeting'];?>" method="post">
                    <?= csrf_field();?>
                    <button type="submit" class="btn btn-danger ml-auto mr-0">Hapus Meeting</button>
                </form>      
              </td>
            </tr>
            <?php }?>
          </tbody>
        </table>
    </div>
    </div>
</div>