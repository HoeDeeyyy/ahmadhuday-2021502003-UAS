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
                
                <a class="btn btn-sm btn-primary mb-3" href="<?php base_url();?>/siswa/tambah"><i class="fa-solid fa-plus"></i>Tambah Siswa</a>
                <table id="dt" class="table">
                  <thead>
                    <tr>
                      <th style="width: 10px">No</th>
                      <th>ID Siswa</th>
                      <th>Nama Siswa</th>
                      <th>Pendidikan</th>
                      <th>Kelas</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $no = 1;
                      foreach ($data_siswa as $r){
                    ?>
                      <tr>
                        <td><?php echo $no; ?></td>
                        <td><?php echo $r['kdsiswa']; ?></td>
                        <td><?php echo $r['nama_siswa']; ?></td>
                        <td><?php echo $r['pendidikan']; ?></td>
                        <td><?php echo $r['kelas']; ?></td>
                        <td>
                          <a href="<?php echo base_url(); ?>/siswa/edit/<?php echo $r['kdsiswa']; ?>" class="btn btn-xs btn-info"><i class="fa-solid fa-edit"></i></a>
                          <a class="btn btn-xs btn-danger" href="#" onclick="return hapusConfig(<?php echo $r['kdsiswa'] ?>);"><i class="fa-solid fa-trash"></i></a>
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
                window.location.href='<?php echo base_url();?>/siswa/hapus/' + id;
              }
            })
          }
        </script>
<?php
echo $this->endSection();