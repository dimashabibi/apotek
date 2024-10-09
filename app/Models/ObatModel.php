<?php

namespace App\Models;

use CodeIgniter\Commands\Utilities\Publish;
use CodeIgniter\Model;

class ObatModel extends Model
{
    protected $table            = 'tbl_obat';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['barcode', 'nama_obat', 'stok_obat', 'satuan', 'jenis_obat', 'id_kategori', 'merk_obat', 'harga_pokok', 'harga_jual', 'stok_min', 'keterangan_obat', 'supplier'];


    public function getObat()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('tbl_obat');
        $builder->select('tbl_obat.*, tbl_kategori.nama_kategori');
        $builder->join('tbl_kategori', 'tbl_kategori.id = tbl_obat.id_kategori', 'left');
        $query = $builder->get();

        return $query->getResultArray();
    }
}
