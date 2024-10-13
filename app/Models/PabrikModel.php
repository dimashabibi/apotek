<?php

namespace App\Models;

use CodeIgniter\Model;

class PabrikModel extends Model
{
    protected $table            = 'tbl_pabrik';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['nama_pabrik', 'alamat_pabrik', 'kota', 'no_telp', 'no_hp', 'no_rekening', 'npwp', 'ket_pabrik'];
}
