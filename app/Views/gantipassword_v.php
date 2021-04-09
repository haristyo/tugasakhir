<div class="container-fluid w-75 h-100"  style="background-color:#fbeeac; border-radius:10px; margin-top:7%; padding:1%;">
    <div class="row p-4">
        <div class="col-12 col-sm-12 col-md-6 h-100 mb-2">
            <img src="<?=base_url('/img/register.jpg')?>" class="w-100" style="border-radius:10px;" alt="Login" >  
        </div>
        <div class="col-12 col-xs-12 col-sm-12 col-md-6 h-100 w-100">
        <div class="section-title text-center">
            <?php if(session()->getFlashData('password')) :?>
              <div class="alert alert-success" role="alert">
                <?= session()->getFlashData('password') ?>
              </div>
            <?php endif;?>
        </div>
            <form class="" method="post" action="/user/updatepassword">
            <?= csrf_field(); ?>
            <input type="hidden" name="id_user" value="<?= $profil['id_user']?>">
                <div class="form-group">
                    <label for="password">Masukkan Kata Sandi Lama</label>
                    <input type="password" class="form-control" id="password" name="password"  value="<?=old('password')?>">
                    <!-- <small id="emailHelp" class="form-text text-muted">enter your email or username</small> -->
                </div>
                <div class="form-group">
                    <label for="password1">Masukkan Kata Sandi Baru</label>
                    <input type="password" class="form-control <?= ($validation->hasError('password1')) ? 'is-invalid' : '' ;?>" id="password1" name="password1" value="<?= old('password1')?>">
                    <div class="invalid-feedback">
                        <?=$validation->getError('password1');?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="password2">Konfirmasi Password Baru</label>
                    <input type="password" class="form-control <?= ($validation->hasError('password2')) ? 'is-invalid' : '' ;?>" id="password2" name="password2"  value="<?=old('password2')?>">
                    <div class="invalid-feedback">
                        <?=$validation->getError('password2');?>
                    </div>
                </div>
                <button type="submit" class="btn btn-success">Masuk</button>
            </form>
        </div>

    </div>
</div>
