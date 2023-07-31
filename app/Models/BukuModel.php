<?php

namespace App\Models;

use CodeIgniter\Model;

class BukuModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'buku';
    protected $primaryKey       = 'kdbuku';
    protected $useAutoIncrement = false;
    protected $allowedFields    = ['kdbuku', 'judul_buku', 'pengarang', 'kdrak', 'status'];
}
