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
                    <input type="hidden" name="param" id="param" value="<?php echo $edit_data['kdpeminjaman']; ?>">
                    <?php
                    }
                    ?>
                    <div class="form-group">
                        <label for="kdpeminjaman">ID Peminjaman</label>
                        <input type="text" name="kdpeminjaman" id="kdpeminjaman" value="<?php echo empty(set_value('kdpeminjaman')) ? (empty($edit_data['kdpeminjaman']) ? "":$edit_data['kdpeminjaman']) : set_value('kdpeminjaman'); ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="kdsiswa">ID Siswa</label>
                        <div class="col-sm-14">
                            <select name="kdsiswa" id="kdsiswa" class="form-control">
                                <option value="">Nama Siswa</option>
                                <?php
                                include "koneksi.php";
                                $query_siswa = mysqli_query($con, "SELECT * FROM siswa") or die
                                    (mysqli_error($con));
                                while($data_siswa = mysqli_fetch_array($query_siswa)){
                                    echo "<option value= $data_siswa[kdsiswa]> $data_siswa[nama_siswa]</option>";
                                } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="kdpegawai">ID Pegawai</label>
                        <div class="col-sm-14">
                            <select name="kdpegawai" id="kdpegawai" class="form-control">
                                <option value="">Nama Pegawai</option>
                                <?php
                                include "koneksi.php";
                                $query_pegawai = mysqli_query($con, "SELECT * FROM pegawai") or die
                                    (mysqli_error($con));
                                while($data_pegawai = mysqli_fetch_array($query_pegawai)){
                                    echo "<option value= $data_pegawai[kdpegawai]> $data_pegawai[nama_pegawai]</option>";
                                } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="kdbuku">ID Buku</label>
                        <div class="col-sm-14">
                            <select name="kdbuku" id="kdbuku" class="form-control">
                                <option value="">Pilih Buku</option>
                                <?php
                                include "koneksi.php";
                                $query_buku = mysqli_query($con, "SELECT * FROM buku") or die
                                    (mysqli_error($con));
                                while($data_buku = mysqli_fetch_array($query_buku)){
                                    echo "<option value= $data_buku[kdbuku]> $data_buku[judul_buku]</option>";
                                } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="tgl_peminjaman">Tanggal Pinjam</label>
                        <input type="text" name="tgl_peminjaman" id="tgl_peminjaman" value="<?php echo empty(set_value('tgl_peminjaman')) ? (empty($edit_data['tgl_peminjaman']) ? "":$edit_data['tgl_peminjaman']) : set_value('tgl_peminjaman'); ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="tgl_pengembalian">Tanggal Kembali</label>
                        <input type="text" name="tgl_pengembalian" id="tgl_pengembalian" value="<?php echo empty(set_value('tgl_pengembalian')) ? (empty($edit_data['tgl_pengembalian']) ? "":$edit_data['tgl_pengembalian']) : set_value('tgl_pengembalian'); ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="ket_telat">Ket. Telat</label>
                        <input type="text" name="ket_telat" id="ket_telat" value="<?php echo empty(set_value('ket_telat')) ? (empty($edit_data['ket_telat']) ? "":$edit_data['ket_telat']) : set_value('ket_telat'); ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="ket_denda">Ket. Denda</label>
                        <input type="text" name="ket_denda" id="ket_denda" value="<?php echo empty(set_value('ket_denda')) ? (empty($edit_data['ket_denda']) ? "":$edit_data['ket_denda']) : set_value('ket_denda'); ?>" class="form-control">
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