<?php
echo $this->extend('template/index');
echo $this->section('content');
?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><?php echo $title_card ?></h3>
            </div>
            <!-- card header -->
            <form action="<?php echo $action; ?>" method="post">
                <div class="card-body">
                    <?php if (validation_errors()) {
                    ?>
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                        <h5><i class="icon fas fa-ban"></i> Alert !</h5>
                        <?php echo validation_list_errors() ?>
                    </div>
                    <?php 
                    }
                    ?>

                    <?php
                    if (session()->getFlashdata('error')){
                    ?>
                    <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                            <h5><i class="icon fas fa-warning"></i> Error</h5>
                            <?php echo session()->getFlashdata('error'); ?>
                        </div>
                    <?php
                    }
                    ?>

                    <?= csrf_field() ?>
                    <?php
                    if (current_url(true)->getSegment(2) == 'edit'){
                    ?>
                    <input type="hidden" name="param" id="param" value="<?php echo $edit_data['kdpegawai']; ?>">
                    <?php
                    }
                    ?>
                    <div class="form-group">
                        <label for="kdpegawai">ID Pegawai</label>
                        <input type="text" name="kdpegawai" id="kdpegawai" value="<?php echo empty(set_value('kdpegawai')) ? (empty($edit_data['kdpegawai']) ? "":$edit_data['kdpegawai']) : set_value('kdpegawai'); ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="nama_pegawai">Nama Pegawai</label>
                        <input type="text" name="nama_pegawai" id="nama_pegawai" value="<?php echo empty(set_value('nama_pegawai')) ? (empty($edit_data['nama_pegawai']) ? "":$edit_data['nama_pegawai']) : set_value('nama_pegawai'); ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="jabatan">Jabatan</label>
                        <input type="text" name="jabatan" id="jabatan" value="<?php echo empty(set_value('jabatan')) ? (empty($edit_data['jabatan']) ? "":$edit_data['jabatan']) : set_value('jabatan'); ?>" class="form-control">
                    </div>
                </div>
                    
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary"><i class="fa-solid fa-save"></i> Simpan</button>
                    </div>
            </form>
        </div>
    </div>
</div>
<?php
echo $this->endSection();