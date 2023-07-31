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
                    <input type="hidden" name="param" id="param" value="<?php echo $edit_data['kdsiswa']; ?>">
                    <?php
                    }
                    ?>
                    <div class="form-group">
                        <label for="kdsiswa">ID Siswa</label>
                        <input type="text" name="kdsiswa" id="kdsiswa" value="<?php echo empty(set_value('kdsiswa')) ? (empty($edit_data['kdsiswa']) ? "":$edit_data['kdsiswa']) : set_value('kdsiswa'); ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="nama_siswa">Nama Siswa</label>
                        <input type="text" name="nama_siswa" id="nama_siswa" value="<?php echo empty(set_value('nama_siswa')) ? (empty($edit_data['nama_siswa']) ? "":$edit_data['nama_siswa']) : set_value('nama_siswa'); ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="pendidikan">Pendidikan</label>
                        <input type="text" name="pendidikan" id="pendidikan" value="<?php echo empty(set_value('pendidikan')) ? (empty($edit_data['pendidikan']) ? "":$edit_data['pendidikan']) : set_value('pendidikan'); ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="kelas">Kelas</label>
                        <input type="text" name="kelas" id="kelas" value="<?php echo empty(set_value('kelas')) ? (empty($edit_data['kelas']) ? "":$edit_data['kelas']) : set_value('kelas'); ?>" class="form-control">
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