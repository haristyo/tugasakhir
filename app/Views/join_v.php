<div class="container-fluid w-75 h-100"  style="background-color:#fbeeac; border-radius:10px; margin-top:7%; padding:1%;">
    <div class="row p-4">
        <div class="col-12 col-sm-12 col-md-6 h-100 mb-2 my-auto pb-3">
            <img src="<?=base_url('/img/team1.png')?>" class="w-100" style="border-radius:10px;" alt="Login" >  
        </div>
        <div class="col-12 col-sm-12 col-md-6 h-100 w-100">
            <form class="" method="post" action="/proyek/joined">
            <?= csrf_field(); ?>
                <div class="form-group">
                    <label for="kode_join">Kode Join</label>
                    <input type="text" class="form-control <?php if ($validation->hasError('kode_join')) {echo 'is-invalid';} elseif(session()->getFlashData('kode_join')) {echo 'is-invalid';} ;?>" id="kode_join" name="kode_join"  value="<?=old('kode_join')?>">
                    <!-- <small id="emailHelp" class="form-text text-muted">enter your email or username</small> -->
                    <div class="invalid-feedback">
                        <?=$validation->getError('kode_join');?>
                        <?=session()->getFlashData('kode_join');?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="password_project">Kata Sandi</label>
                    <input type="text" class="form-control <?= ($validation->hasError('password_project')) ? 'is-invalid' : '' ;?>" id="password_project" name="password_project"  value="<?=old('password_project')?>">
                    <div class="invalid-feedback">
                        <?=$validation->getError('password_project');?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="position">Posisi</label>
                    <select class="custom-select <?= ($validation->hasError('position')) ? 'is-invalid' : '' ;?>" name="position">
                        <option selected>Pilih Posisi</option>
                        <option value="Development Team" <?php if (old('position')=="Development Team") {echo "selected='selected'";}?>>Development Team</option>
                        <option value="Product Owner" <?php if (old('position')=="Product Owner") {echo "selected='selected'";}?>>Product Owner</option>
                    </select>
                    <div class="invalid-feedback">
                        <?=$validation->getError('position');?>
                    </div>
                </div>
                <div class="form-group">
                    <a class="" href="<?= base_url('/proyek/create');?>">Membuat Proyek Baru ? </a>
                    
                </div>
                <button type="submit" class="btn btn-success">Bergabung</button>
            </form>
        </div>

    </div>
</div>
