<div class="container-fluid w-75 h-100 mt-2"  style="background-color:#fbeeac; border-radius:10px;padding:1%; min-height:88vh;">
<h1 class="text-center"> Buat Proyek Baru</h1>
<hr width="100%" color="black" style="height:5px;">
    <form class="" action="/proyek/add" method="post">
            <?= csrf_field(); ?>
                <div class="form-group">
                    <label for="nama_project">Nama Proyek</label>
                    <input type="text" class="form-control <?= ($validation->hasError('nama_project')) ? 'is-invalid' : '' ;?>" id="nama_project" name="nama_project" autofocus value="<?= old('nama_project')?>">
                    <div class="invalid-feedback">
                        <?=$validation->getError('nama_project');?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="deskripsi">Deskripsi</label>
                    <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3"><?= old('deskripsi')?></textarea>
                    <div class="invalid-feedback">
                        <?=$validation->getError('deskripsi');?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="kode_join">Kode Proyek</label>
                    <input type="text" class="form-control <?= ($validation->hasError('kode_join')) ? 'is-invalid' : '' ;?>" id="kode_join" name="kode_join" value="<?= old('kode_join')?>">
                    
                    <div class="invalid-feedback">
                        <?=$validation->getError('kode_join');?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="password_project">Kata Sandi Proyek</label>
                    <input type="text" class="form-control <?= ($validation->hasError('password_project')) ? 'is-invalid' : '' ;?>" id="password_project" name="password_project" value="<?= old('password_project')?>">
                    <div class="invalid-feedback">
                        <?=$validation->getError('password_project');?>
                    </div>
                </div>
                <button type="submit" class="btn btn-success my-2 w-100">Buat Proyek Baru</button>
                <div class="form-group">
                    <label class="form-check-label " for="exampleCheck1">Bergabung dengan proyek yang sudah ada ? 
                    <a class="" href="<?= base_url('/proyek/join');?>">Gabung</a>
                    </label>
                </div>
            </form>
</div>