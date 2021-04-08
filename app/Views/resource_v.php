    <div id='content' class='px-md-5'>
    <!-- Button trigger modal -->
    <div class="d-flex">
        <button type="button" class="btn btn-success d-flex p-4 mt-3 mx-2" data-toggle="modal" data-target="#createimage">
            <h6 class="my-auto" >Tambah Gambar</h6>
            <span class="ml-2 my-auto fa fa-image" ></span>
        </button>
        <button type="button" class="btn btn-success d-flex p-4 mt-3 mx-2" data-toggle="modal" data-target="#createdocument">
            <h6 class="my-auto" >Tambah Dokumen</h6>
            <span class="ml-2 my-auto fa fa-file" ></span>
        </button>
        <button type="button" class="btn btn-success d-flex p-4 mt-3 mx-2" data-toggle="modal" data-target="#createlink">
            <h6 class="my-auto" >Tambah Tautan</h6>
            <span class="ml-2 my-auto fa fa-file" ></span>
        </button>
    </div>
        <!-- end Button trigger modal -->
        <!-- Modal -->
            <div class="modal fade" id="createimage" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" >
            <div class="modal-content" style="background-color:#fbeeac;">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Gambar</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="" method="post" action="/proyek/createimage" enctype="multipart/form-data">
                    <div class="modal-body">
                            <?= csrf_field(); ?>
                            <input type="hidden" name="id_project" value=<?=$member['id_project'];?> />
                            <div class="custom-file">
                                <input type="file" class="custom-file-input <?php if($validation->hasError('file')==TRUE){ echo "is-invalid";}?>" name="file" id="file">
                                <label class="custom-file-label" for="file">Pilih Berkas anda</label>
                                <div class="invalid-feedback">
                                    <?=$validation->getError('file');?>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="deskripsi_file">Deskripsi</label>
                                <textarea class="w-100" id="deskripsi_file" name="deskripsi_file" rows="3"><?= old('deskripsi_file')?></textarea>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Tambah Gambar</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    </div>
                </form>
            </div>

            </div>
            </div>
            <?php if ($validation->hasError('file')) {echo "<script> $('#createimage').modal('show'); </script>"; } ?>
        <!-- end modal-->

        <!-- Modal -->
            <div class="modal fade" id="createdocument" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" >
            <div class="modal-content" style="background-color:#fbeeac;">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Dokumen</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="" method="post" action="/proyek/createdocument" enctype="multipart/form-data">
                    <div class="modal-body">
                            <?= csrf_field(); ?>
                            <input type="hidden" name="id_project" value=<?=$member['id_project'];?> />
                            <div class="custom-file">
                                <input type="file" class="custom-file-input <?php if($validation->hasError('filedocument')==TRUE){ echo "is-invalid";}?>" name="filedocument" id="filedocument">
                                <label class="custom-file-label" for="filedocument">Pilih Berkas anda</label>
                                <div class="invalid-feedback">
                                    <?=$validation->getError('filedocument');?>
                                </div>
                                <small>File harus berformat doc,docx,ppt,pptx,xls,xlsx,pdf,txt </small>
                            </div>
                            
                            <div class="form-group">
                                <label for="deskripsi_file">Deskripsi</label>
                                <textarea class="w-100" id="deskripsi_file" name="deskripsi_file" rows="3"><?= old('deskripsi_file')?></textarea>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Tambah Dokumen</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    </div>
                </form>
            </div>

            </div>
            </div>
            <?php if ($validation->hasError('filedocument')) {echo "<script> $('#createdocument').modal('show'); </script>"; } ?>
        <!-- end modal-->
        <!-- Modal -->
            <div class="modal fade" id="createlink" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" >
            <div class="modal-content" style="background-color:#fbeeac;">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Tautan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="" method="post" action="/proyek/createlink" >
                    <div class="modal-body">
                            <?= csrf_field(); ?>
                            <input type="hidden" name="id_project" value=<?=$member['id_project'];?> />
                            
                            
                            <div class="form-group">
                                <label for="link">Tautan</label>
                                <input type="text" name="link" id="link" class="form-control <?php if ($validation->getError('link')) {echo "is-invalid";}?>">
                                <div class="invalid-feedback">
                                    <?=$validation->getError('link');?>
                                </div>
                                <small>Tautan harus menyertakan protokol (http://, https://, ftp://, dll.) </small>
                            </div>
                            <div class="form-group">
                                <label for="deskripsi_link">Deskripsi</label>
                                <textarea class="w-100" id="deskripsi_link" name="deskripsi_link" rows="3"><?= old('deskripsi_link')?></textarea>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Tambah Tautan</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    </div>
                </form>
            </div>

            </div>
            </div>
            <?php if ($validation->hasError('link')) {echo "<script> $('#createlink').modal('show'); </script>"; } ?>
        <!-- end modal-->

        <div class="d-flex">
            <div class="ml-auto mr-0"><?= $pager->links('file','pagers') ;?></div>
        </div>
        <div class="row">
            <?php foreach ($file as $files) {?>
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
                    <?php if($files['type']=='gambar'){?>
                        <div class="card w-100 m-1 h-100" style="border-radius:5%;" data-toggle="modal" data-target="#file<?=$files['id_file'];?>">
                            <div style="overflow: hidden; padding: 5px; max-height: 150px; min-height: 150px;" class="mt-2 h-100">
                                    <img src="<?=base_url("resource/".$files['id_project']."/".$files['nama_file']); ?>" class="my-auto" alt="<?=$files['nama_asli']; ?>" 
                                    style="max-height: 150px; display: block; width: 100%;">
                            </div>
                            <div class="card-body w-100 h-100">
                            <h5 class="card-title mx-atuo" ><?=$files['nama_asli']; ?></h5>
                            <p class="card-text "><?php echo nl2br(substr($files['deskripsi_file'],0,75))."..."; ?></p>
                            
                            </div>
                        </div>
                        <div class="modal fade" id="file<?=$files['id_file'];?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-xl" >
                            <div class="modal-content" style="background-color:#fbeeac;">
                                <div class="modal-header d-flex py-2">
                                    <h5 class="modal-title mr-auto ml-4" id="exampleModalLabel"><?=$files['nama_asli']; ?></h5>
                                    <h6 class="modal-title ml-auto mr-0 pl-2" style="color:black;" id="exampleModalLabel" ><?=$files['username']; ?> Pada <?=$files['created_file']; ?></h6>
                                    
                                    <button type="button" class="close ml-0" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                <img src="<?=base_url("resource/".$files['id_project']."/".$files['nama_file']); ?>" class="w-100" alt="<?=$files['nama_asli']; ?>" height="auto">
                                <h6 style="color:black;" class="mt-2"><?=$files['deskripsi_file']; ?> </h6>
                                </div>
                                <div class="modal-footer">

                                    <?php if ($member['position'] == "Scrum Master" || $member['id_member']==$files['uploader_file']) {?><button type="submit" class="btn btn-danger">Hapus Gambar</button><?php }?>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                </div>
                            </div>

                            </div>
                        </div>
                        
                    <?php } elseif($files['type']=='dokumen'){?>
                        <div class="card w-100 m-1 h-100" style="border-radius:5%;" data-toggle="modal" data-target="#file<?=$files['id_file'];?>">
                            <div style="overflow: hidden; padding: 5px; max-height: 150px; min-height: 150px;" class="mt-2 w-100">
                                <div class="h-100 w-100 d-flex"><i class="m-auto fa fa-file fa-5x"></i></div>
                            </div>
                            <div class="card-body w-100 h-100">
                            <h5 class="card-title mx-atuo" ><?=$files['nama_asli']; ?></h5>
                            <p class="card-text "><?php echo nl2br(substr($files['deskripsi_file'],0,75))."..."; ?></p>
                            
                            </div>
                        </div>
                        <div class="modal fade" id="file<?=$files['id_file'];?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-md" >
                            <div class="modal-content" style="background-color:#fbeeac;">
                                <div class="modal-header d-flex py-2">
                                    <h5 class="modal-title mr-auto ml-4" id="exampleModalLabel"><?=$files['nama_asli']; ?></h5>
                                    <h6 class="modal-title ml-auto mr-0 pl-2" style="color:black;" id="exampleModalLabel" ><?=$files['username']; ?> Pada <?=$files['created_file']; ?></h6>
                                    
                                    <button type="button" class="close ml-0" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                <div class="h-100 w-100 d-flex"><i class="m-auto fa fa-file fa-5x"></i></div>
                                <h6 style="color:black;" class="mt-2"><?=$files['deskripsi_file']; ?> </h6>
                                </div>
                                <div class="modal-footer d-flex">
                                    <a class="btn btn-primary ml-0 mr-auto" href="<?=base_url("resource/".$files['id_project']."/".$files['nama_file']); ?>" >Unduh Dokumen</a>
                                    <?php if ($member['position'] == "Scrum Master" || $member['id_member']==$files['uploader_file']) {?><button type="submit" class="btn btn-danger">Hapus Dokumen</button><?php }?>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                </div>
                            </div>

                            </div>
                        </div>
                        
                    <?php } elseif($files['type']=='tautan'){?>
                        <div class="card w-100 m-1 h-100" style="border-radius:5%;" data-toggle="modal" data-target="#file<?=$files['id_file'];?>">
                            <div style="overflow: hidden; padding: 5px; max-height: 150px; min-height: 150px;" class="mt-2 w-100">
                                <div class="h-100 w-100 d-flex"><i class="m-auto fa fa-file fa-5x"></i></div>
                            </div>
                            <div class="card-body w-100 h-100">
                            <h5 class="card-title mx-atuo" ><?=$files['nama_asli']; ?></h5>
                            <p class="card-text "><?php echo nl2br(substr($files['deskripsi_file'],0,75))."..."; ?></p>
                            
                            </div>
                        </div>
                        <div class="modal fade" id="file<?=$files['id_file'];?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-md" >
                            <div class="modal-content" style="background-color:#fbeeac;">
                                <div class="modal-header d-flex py-2">
                                    <div class="modal-title">
                                        <h5 class="mr-auto ml-4 " id="exampleModalLabel"><?=$files['nama_asli']; ?></h5>
                                        <h6 class="ml-auto mr-0 pl-2" style="color:black;" id="exampleModalLabel" ><?=$files['username']; ?> Pada <?=$files['created_file']; ?></h6>
                                        <button type="button" class="close ml-0" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div> 
                                </div>
                                <div class="modal-body">
                                <div class="h-100 w-100 d-flex"><i class="m-auto fa fa-external-link fa-5x"></i></div>
                                <h6 style="color:black;" class="mt-2"><?=$files['deskripsi_file']; ?> </h6>
                                </div>
                                <div class="modal-footer d-flex">
                                    <a class="btn btn-primary ml-0 mr-auto" href="<?=$files['nama_asli']?>" target="_blank">Buka tautan</a>
                                    <?php if ($member['position'] == "Scrum Master" || $member['id_member']==$files['uploader_file']) {?><button type="submit" class="btn btn-danger">Hapus Tautan</button><?php }?>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                </div>
                            </div>

                            </div>
                        </div>
                        
                    <?php }?>
                </div>
            <?php }?>

        </div>
</div>
<script type="application/javascript">
    $('input[type="file"]').change(function(e){
        var fileName = e.target.files[0].name;
        $('.custom-file-label').html(fileName);
    });
</script>