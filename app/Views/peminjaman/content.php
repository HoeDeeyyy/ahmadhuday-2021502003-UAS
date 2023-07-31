<?php
echo $this->extend('template/index');
echo $this->section('content');
?>
<div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"><?php echo $title_card; ?></h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <?php
                if (session()->getFlashdata('success')){
                ?>
                <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                        <h5><i class="icon fas fa-check"></i> Success</h5>
                        <?php echo session()->getFlashdata('success'); ?>
                    </div>
                <?php
                }
                ?>
                
                <a class="btn btn-sm btn-primary mb-3" href="<?php base_url();?>/peminjaman/tambah"><i class="fa-solid fa-plus"></i>Tambah Peminjaman</a>
                <table id="dt" class="table">
                  <thead>
                    <tr>
                      <th style="width: 10px">No</th>
                      <th>ID Peminjaman</th>
                      <th>Nama Siswa</th>
                      <th>Nama Pegawai</th>
                      <th>Judul Buku</th>
                      <th>Tanggal Pinjam</th>
                      <th>Tanggal Kembali</th>
                      <th>Ket. Telat</th>
                      <th>Ket. Denda</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      include "koneksi.php";
                      $no = 1;
                      $ambildata = mysqli_query($con, " SELECT * FROM peminjaman INNER JOIN siswa ON peminjaman.kdsiswa=siswa.kdsiswa INNER JOIN buku ON peminjaman.kdbuku=buku.kdbuku INNER JOIN pegawai ON peminjaman.kdpegawai=pegawai.kdpegawai") or die (mysqli_error($con));
                      while($tampil = mysqli_fetch_array($ambildata)){
                    ?>
                      <tr>
                        <td><?php echo $no; ?></td>
                        <td><?php echo $tampil['kdpeminjaman']; ?></td>
                        <td><?php echo $tampil['nama_siswa']; ?></td>
                        <td><?php echo $tampil['nama_pegawai']; ?></td>
                        <td><?php echo $tampil['judul_buku']; ?></td>
                        <td><?php echo $tampil['tgl_peminjaman']; ?></td>
                        <td><?php echo $tampil['tgl_pengembalian']; ?></td>
                        <td><?php echo $tampil['ket_telat']; ?></td>
                        <td><?php echo $tampil['ket_denda']; ?></td>
                        <td>
                          <a href="<?php echo base_url(); ?>/peminjaman/edit/<?php echo $tampil['kdpeminjaman']; ?>" class="btn btn-xs btn-info"><i class="fa-solid fa-edit"></i></a>
                          <a class="btn btn-xs btn-danger" href="#" onclick="return hapusConfig(<?php echo $tampil['kdpeminjaman'] ?>);"><i class="fa-solid fa-trash"></i></a>
                        </td>
                      </tr>
                    <?php
                      $no++;
                      }
                    ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div> 
        <script>
          function hapusConfig(id){
            Swal.fire({
              title: 'Anda yakin akan menghapus data ini?',
              text: "Data akan dihapus secara permanen",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Ya, Hapus data ini!'
            }).then((result) => {
              if (result.isConfirmed) {
                window.location.href='<?php echo base_url();?>/peminjaman/hapus/' + id;
              }
            })
          }
        </script>
<?php
echo $this->endSection();