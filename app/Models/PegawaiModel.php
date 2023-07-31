<?php

namespace App\Models;

use CodeIgniter\Model;

class PegawaiModel extends Model
{ 
    protected $DBGroup          = 'default';
    protected $table            = 'pegawai';
    protected $primaryKey       = 'kdpegawai';
    protected $useAutoIncrement = false;
    protected $allowedFields    = ['kdpegawai', 'nama_pegawai', 'jabatan'];
}
