<?php

namespace App\Models;

use CodeIgniter\Model;

class SiswaModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'siswa';
    protected $primaryKey       = 'kdsiswa';
    protected $useAutoIncrement = false;
    protected $allowedFields    = ['kdsiswa', 'nama_siswa', 'pendidikan', 'kelas'];
}
