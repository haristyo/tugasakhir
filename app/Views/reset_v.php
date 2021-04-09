<div class="container-fluid w-75 h-100"  style="background-color:#fbeeac; border-radius:10px; margin-top:7%; padding:1%;">
    <div class="row p-4">
        <div class="col-12 col-sm-12 col-md-6 h-100 mb-2">
            <img src="<?=base_url('/img/forgot.png')?>" class="w-100" style="border-radius:10px;" alt="Login" >  
        </div>
        <div class="col-12 col-xs-12 col-sm-12 col-md-6 h-100 w-100 my-auto">
        <div class="section-title text-center">
            <?php if(session()->getFlashData('pesan')) :?>
              <div class="alert alert-danger" role="alert">
                <?= session()->getFlashData('pesan') ?>
              </div>
            <?php endif;?>
        </div>
            <form class="" method="post" action="/user/prosesresetpassword/<?=$reset['id_user']?>">
            <?= csrf_field(); ?>
            <input type=hidden value="<?=session()->get('_ci_previous_url');?>" name="back">
            <div class="form-group">
                    <label for="password1">Kata Sandi</label>
                    <input type="password" class="form-control <?= ($validation->hasError('password1')) ? 'is-invalid' : '' ;?>" id="password1" name="password1" value="<?= old('password1')?>">
                    <small id="passwordHelp" class="form-text text-muted">Kata sandi paling sedikit 8 karakter</small>
                    <div class="invalid-feedback">
                        <?=$validation->getError('password1');?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="password2">Masukkan ulang Kata Sandi</label>
                    <input type="password" class="form-control <?= ($validation->hasError('password2')) ? 'is-invalid' : '' ;?>" id="password2" name="password2" value="<?= old('password2')?>">
                    <div class="invalid-feedback">
                        <?=$validation->getError('password2');?>
                    </div>
                </div>
                <button type="submit" class="btn btn-success">Reset Password</button>
                <div class="form-group">
                    <label class="form-check-label" for="exampleCheck1">Sudah Ingat ? 
                    <a class="" href="<?= base_url('/login');?>">Masuk</a>
                    </label>
                </div>
            </form>
        </div>

    </div>
</div>
