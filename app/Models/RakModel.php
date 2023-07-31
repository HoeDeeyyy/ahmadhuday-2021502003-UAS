<?php

namespace App\Models;

use CodeIgniter\Model;

class RakModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'rak';
    protected $primaryKey       = 'kdrak';
    protected $useAutoIncrement = false;
    protected $allowedFields    = ['kdrak', 'nama_rak'];
}
