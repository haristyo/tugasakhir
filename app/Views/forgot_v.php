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
            <form class="" method="post" action="/user/proses_lupa">
            <?= csrf_field(); ?>
            <input type=hidden value="<?=session()->get('_ci_previous_url');?>" name="back">
                <div class="form-group">
                    <label for="useremail">Alamat Surel atau nama pengguna</label>
                    <input type="text" class="form-control" id="useremail" name="useremail"  value="<?=old('useremail')?>">
                    <!-- <small id="emailHelp" class="form-text text-muted">enter your email or username</small> -->
                </div>
                <button type="submit" class="btn btn-success">Atur Ulang Kata Sandi</button>
                <div class="form-group">
                    <label class="form-check-label mt-2" for="exampleCheck1">Sudah ingat ? 
                    <a class="" href="<?= base_url('/login');?>">Masuk</a>
                    </label>
                </div>
            </form>
        </div>

    </div>
</div>
