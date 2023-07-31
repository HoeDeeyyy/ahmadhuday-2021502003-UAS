<?php

namespace App\Models;

use CodeIgniter\Model;

class PeminjamanModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'peminjaman';
    protected $primaryKey       = 'kdpeminjaman';
    protected $useAutoIncrement = false;
    protected $allowedFields    = ['kdpeminjaman', 'kdsiswa', 'kdpegawai', 'kdbuku', 'tgl_peminjaman', 'tgl_pengembalian', 'ket_telat', 'ket_denda'];

}
