<div class="container px-2 w-75 py-4 center"  style="background-color:#fbeeac; border-radius:10px;">
<h1 class="text-center"> Profil Saya</h1>
<hr width="75%" color="black" style="height:5px;">
  <div class=" d-flex w-75 mx-auto">
    <a href="<?= base_url('/user/gantipassword/');?>" class="mr-0 ml-auto btn btn-outline-dark">Ubah Kata Sandi</a>
    <a href="<?= base_url('/profil/edit/');?>" class="mr-0 ml-2 btn btn-primary">Ubah Profil</a>
  </div>
  <div class=" d-flex w-75 mx-auto p-2">
    <img src="<?= base_url('/img/profil/'.$profil['foto_profile'])?>" class="img-fluid" style="border-radius:5%" width="100%" height="auto" alt=<?= $profil['foto_profile']?>">
  </div>
  <table class="table table-borderless mx-auto "  style="width:65%" align="center">
  <!-- <table> -->
    <thead>
      <tr>
        <th scope="col" colspan="3" class="text-center">Profil</th>
      </tr>
    </thead>
    <tbody >
      <tr >
        <td width="20px">Nama Pengguna</td>
        <td width="25px">:</td>
        <th width="25px"><?= $profil['username'];?></th>
      </tr>
      <tr>
        <td>Nama Lengkap</td>
        <td>:</td>
        <th><?= $profil['nama_user'];?></th>
      </tr>
      <tr>
        <td>Email</td>
        <td>:</td>
        <th><?= $profil['email'];?></th>
      </tr>
      <tr>
        <td>Tanggal Bergabung</td>
        <td>:</td>
        <th><?= date("d F Y H:i:s", strtotime($profil['created_user']))?></th>
        
      </tr>
    </tbody>
  </table>
</div>