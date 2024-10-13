<?php

namespace App\Models;

use CodeIgniter\Model;

class EtiketModel extends Model
{
    protected $table            = 'tbl_etiket';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';

    protected $allowedFields    = ['nama_etiket', 'ket_etiket'];
}
