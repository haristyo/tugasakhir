<div class="container w-75 h-100"  style="background-color:#fbeeac; border-radius:10px;padding:1%;">
        <form class="" action="/user/update" method="post"  enctype="multipart/form-data">
            <?= csrf_field(); ?>
    <div class="row  p-4">
        <div class="col-6 col-sm-12 col-md-6 h-100 p-2">
            <img src="<?= base_url('/img/profil/'.$profil['foto_profile'])?>" class="w-100" style="border-radius:10px;" alt="Login" >  
            <div class="form-control rows-2">
            <input type="file" class=" form-control-file w-100 <?= ($validation->hasError('foto_profile')) ? 'is-invalid' : '' ;?>" id="foto_profile" name="foto_profile">
            <label class="" for="foto_profile">Masukkan Foto Profil Baru <br><small color=red>*(jika ingin diubah)</small></label>
                    <input type="hidden" name="foto_profile_old" value="<?= $profil['foto_profile']?>">
                    <input type="hidden" name="id_user" value="<?= $profil['id_user']?>">
                <div class="invalid-feedback">
                    <?=$validation->getError('foto_profile');?>
                </div>
            </div>
        </div>
        <div class="col-6 col-sm-12 col-md-6 h-100 w-100">
            <input type="hidden" name="is_admin" value="N">
                <div class="form-group">
                    <label for="username">Nama User</label>
                    <input type="text" class="form-control <?= ($validation->hasError('username')) ? 'is-invalid' : '' ;?>" id="username" name="username" autofocus value="<?php if ($back == base_url('/user/update')) { echo old('username');} else { echo $profil['username'];}?>">
                    <small id="emailHelp" class="form-text text-muted">masukkan username</small>
                    <div class="invalid-feedback">
                        <?=$validation->getError('username');?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="nama_user">Nama Lengkap</label>
                    <input type="text" class="form-control <?= ($validation->hasError('nama_user')) ? 'is-invalid' : '' ;?>" id="nama_user" name="nama_user" value="<?php if ($back == base_url('/user/update')) { echo old('nama_user');} else { echo $profil['nama_user'];}?>">
                    <div class="invalid-feedback">
                        <?=$validation->getError('nama_user');?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="email">Alamat Surel</label>
                    <input type="text" class="form-control <?= ($validation->hasError('email')) ? 'is-invalid' : '' ;?>" id="email" name="email" value="<?php if ($back == base_url('/user/update')) { echo old('email');} else { echo $profil['email'];}?>">
                    <div class="invalid-feedback">
                        <?=$validation->getError('email');?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="password">Kata Sandi Untuk Mengkonfirmasi</label>
                    <input type="password" class="form-control <?php if($validation->hasError('password'))  {echo 'is-invalid';} elseif(session()->getFlashData('password')) {echo 'is-invalid';} ;?>" id="password" name="password" value="">
                    <div class="invalid-feedback">
                        <?=$validation->getError('password');?>
                        <?=session()->getFlashData('password');?>
                        
                    </div>
                </div>
                <button type="submit" class="btn btn-primary my-2 w-100">Ubah Profil</button>
            </form>
        </div>

    </div>
</div>
