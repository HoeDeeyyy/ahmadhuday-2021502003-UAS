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
                <table id="dt" class="table">
                  <thead>
                    <tr>
                      <th style="width: 10px">No</th>
                      <th>ID Buku</th>
                      <th>Judul Buku</th>
                      <th>Pengarang</th>
                      <th>Rak</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      include "koneksi.php";
                      $no = 1;
                      $ambildata = mysqli_query($con, " SELECT * FROM buku, rak WHERE buku.kdrak=rak.kdrak") or die (mysqli_error($con));
                      while($tampil = mysqli_fetch_array($ambildata)){
                    ?>
                      <tr>
                        <td><?php echo $no; ?></td>
                        <td><?php echo $tampil['kdbuku']; ?></td>
                        <td><?php echo $tampil['judul_buku']; ?></td>
                        <td><?php echo $tampil['pengarang']; ?></td>
                        <td><?php echo $tampil['nama_rak']; ?></td>
                        <td><?php echo $tampil['status']; ?></td>
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
<?php
echo $this->endSection();