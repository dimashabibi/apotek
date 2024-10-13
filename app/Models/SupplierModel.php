<?php

namespace App\Models;

use CodeIgniter\Model;

class SupplierModel extends Model
{
    protected $table            = 'tbl_supplier';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['nama_supplier', 'alamat_supplier', 'kota', 'no_telp', 'no_hp', 'no_rekening', 'npwp', 'ket_pabrik'];
}
