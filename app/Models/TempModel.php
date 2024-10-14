<?php

namespace App\Models;

use CodeIgniter\Model;

class TempModel extends Model
{
    protected $table            = 'tbl_temp';
    protected $primaryKey       = 'detail_transaksi_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['detail_transaksi_id', 'no_faktur', 'id_obat', 'harga_pokok', 'harga_jual', 'qty', 'sub_total',];
}
