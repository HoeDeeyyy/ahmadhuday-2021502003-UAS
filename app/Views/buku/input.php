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
                    <input type="hidden" name="param" id="param" value="<?php echo $edit_data['kdbuku']; ?>">
                    <?php
                    }
                    ?>
                    <div class="form-group">
                        <label for="kdbuku">ID Buku</label>
                        <input type="text" name="kdbuku" id="kdbuku" value="<?php echo empty(set_value('kdbuku')) ? (empty($edit_data['kdbuku']) ? "":$edit_data['kdbuku']) : set_value('kdbuku'); ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="judul_buku">Judul Buku</label>
                        <input type="text" name="judul_buku" id="judul_buku" value="<?php echo empty(set_value('judul_buku')) ? (empty($edit_data['judul_buku']) ? "":$edit_data['judul_buku']) : set_value('judul_buku'); ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="pengarang">Pengarang</label>
                        <input type="text" name="pengarang" id="pengarang" value="<?php echo empty(set_value('pengarang')) ? (empty($edit_data['pengarang']) ? "":$edit_data['pengarang']) : set_value('pengarang'); ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="kdrak">Rak</label>
                        <div class="col-sm-14">
                            <select name="kdrak" id="kdrak" class="form-control">
                                <option value="">Pilih Rak</option>
                                <?php
                                include "koneksi.php";
                                $query_rak = mysqli_query($con, "SELECT * FROM rak") or die
                                    (mysqli_error($con));
                                while($data_rak = mysqli_fetch_array($query_rak)){
                                    echo "<option value= $data_rak[kdrak]> $data_rak[nama_rak]</option>";
                                } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <input type="text" name="status" id="status" value="<?php echo empty(set_value('status')) ? (empty($edit_data['status']) ? "":$edit_data['status']) : set_value('status'); ?>" class="form-control">
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