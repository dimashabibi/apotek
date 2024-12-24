<?php

namespace App\Models;

use CodeIgniter\Commands\Utilities\Publish;
use CodeIgniter\Model;


class ObatModel extends Model
{
    protected $table            = 'tbl_obat';
    protected $primaryKey       = 'id';
    protected $allowedFields    = [
        'kode_rak',
        'barcode_obat',
        'merk_obat',
        'nama_obat',
        'id_golongan',
        'id_kategori',
        'konsinyasi',
        'stok_min',
        'stok_obat',
        'id_satuan',
        'harga_pokok',
        'harga_jual',
        'id_etiket',
        'deleted_at'
    ];
    protected $useSoftDeletes = true;
    protected $deletedField = 'deleted_at';



    public function getObat()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('tbl_obat');
        $builder->select('tbl_obat.*, tbl_kategori.nama_kategori, tbl_golongan.nama_golongan, tbl_satuan.nama_satuan, tbl_etiket.nama_etiket');

        $builder->join('tbl_golongan', 'tbl_golongan.id = tbl_obat.id_golongan', 'left');
        $builder->join('tbl_kategori', 'tbl_kategori.id = tbl_obat.id_kategori', 'left');
        $builder->join('tbl_satuan',   'tbl_satuan.id = tbl_obat.id_satuan',     'left');
        $builder->join('tbl_etiket',   'tbl_etiket.id = tbl_obat.id_etiket',     'left');
        $builder->where('tbl_obat.deleted_at', null);
        $query = $builder->get();

        return $query->getResultArray();
    }
}
