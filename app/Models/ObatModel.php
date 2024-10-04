<?php

namespace App\Models;

use CodeIgniter\Model;

class ObatModel extends Model
{
    protected $table            = 'tbl_obat';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['barcode', 'nama_obat', 'stok_obat', 'satuan', 'jenis_obat', 'kategori_obat', 'merk_obat', 'harga_pokok', 'harga_jual', 'stok_min', 'keterangan_obat', 'supplier'];
}
