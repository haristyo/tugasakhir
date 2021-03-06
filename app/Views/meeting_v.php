<div id="content" class="p-4 p-md-5 pt-5">
    <table class="table text-center table-dark" >
    <thead>
        <tr>
        <th scope="col"></th>
        <th scope="col">Tanggal Meeting</th>
        <th scope="col">Jam Meeting</th>
        <th scope="col">Agenda</th>
        <th scope="col">Deskripsi</th>
        <th scope="col">Join</th>
        <th scope="col">Kehadiran</th>
        
        </tr>
    </thead>
    <tbody>
    <?php  $i=0; foreach ($meetings as $meetings) { $i++;?>
        <tr>
        <th scope="row"><?=$i;?></th>
        
        <td><?=date("d F Y", strtotime($meetings['time_meeting']));?></td>
        <td><?=date("H:i:s", strtotime($meetings['time_meeting']));?></td>
        <td><?=$meetings['agenda'];?></td>
        <td><?=$meetings['deskripsi'];?></td>
        <td>
            <form action="/proyek/meetingjoin/<?=$meetings['id_meeting'];?>" method="post" target="_blank">
            <?= csrf_field()?>
            <button type="submit" class="btn btn-success" >Gabung</button>
            </form>
        </td>
        <td>Kehadiran</td>
        </tr>
        <?php }?>
    </tbody>
    </table>
</div>
</div>