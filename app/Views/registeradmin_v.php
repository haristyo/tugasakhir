<div id="content" class="px-4 pl-md-5 pr-md-4 pt-5 center">
<div class="container-fluid w-75 h-100"  style="background-color:#fbeeac; border-radius:10px;padding:1%;">
    <div class="row  p-4">
        <div class="col-6 col-sm-12 col-md-6 h-100 p-2">
            <img src="<?=base_url('/img/register.jpg')?>" class="w-100" style="border-radius:10px;" alt="Login" >  
        </div>
        <div class="col-6 col-sm-12 col-md-6 h-100 w-100">
        <form class="" action="/user/addAdmin" method="post">
        <?= csrf_field(); ?>
            
                <div class="form-group">
                    <label for="username">Nama Admin</label>
                    <input type="text" class="form-control <?= ($validation->hasError('username')) ? 'is-invalid' : '' ;?>" id="username" name="username" autofocus value="<?= old('username')?>">
                    <small id="emailHelp" class="form-text text-muted">masukkan nama admin</small>
                    <div class="invalid-feedback">
                        <?=$validation->getError('username');?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="nama_user">Nama Lengkap</label>
                    <input type="text" class="form-control <?= ($validation->hasError('nama_user')) ? 'is-invalid' : '' ;?>" id="nama_user" name="nama_user" value="<?= old('nama_user')?>">
                    <div class="invalid-feedback">
                        <?=$validation->getError('nama_user');?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="email">Alamat Surel</label>
                    <input type="text" class="form-control <?= ($validation->hasError('email')) ? 'is-invalid' : '' ;?>" id="email" name="email" value="<?= old('email')?>">
                    <div class="invalid-feedback">
                        <?=$validation->getError('email');?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="password1">Kata Sandi</label>
                    <input type="password" class="form-control <?= ($validation->hasError('password1')) ? 'is-invalid' : '' ;?>" id="password1" name="password1" value="<?= old('password1')?>">
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

                <div class="form-check">
                    <input class="form-check-input <?= ($validation->hasError('sk')) ? 'is-invalid' : '' ;?>" type="checkbox" value="1" id="defaultCheck1" name="sk"  >
                    <label class="form-check-label" for="defaultCheck1">
                        Saya dengan sadar mendaftarkan akun terkait sebagai admin
                    </label>
                    <div class="invalid-feedback">
                        <?=$validation->getError('sk');?>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary my-2 w-100">Daftar</button>
                <div class="form-group">
                    <label class="form-check-label " for="exampleCheck1">Sudah Memiliki akun ? 
                    <a class="" href="<?= base_url('/login');?>">Masuk</a>
                    </label>
                </div>
            </form>
        </div>

    </div>
</div>
</div>
</div>
