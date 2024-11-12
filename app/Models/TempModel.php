<?php

namespace App\Models;

use CodeIgniter\Model;

class TempModel extends Model
{
    protected $table            = 'tbl_temp';
    protected $primaryKey       = 'detail_transaksi_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['detail_transaksi_id', 'no_faktur', 'id_obat', 'harga_pokok', 'harga_jual', 'qty', 'sub_total'];

    public function getTemp($no_faktur)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('tbl_temp');

        $builder->select('tbl_temp.detail_transaksi_id as id, tbl_temp.id_obat as obat, tbl_obat.kode_rak as kode_rak, tbl_obat.nama_obat as nama_obat, tbl_obat.barcode_obat as barcode_obat, tbl_obat.id_satuan as nama_satuan, tbl_obat.id_kategori as nama_kategori,  tbl_temp.harga_pokok as harga_pokok, tbl_temp.harga_jual as harga_jual, tbl_temp.qty as qty, tbl_temp.sub_total as sub_total, tbl_satuan.nama_satuan, tbl_kategori.nama_kategori');
        $builder->join('tbl_obat', 'tbl_obat.id = tbl_temp.id_obat');
        $builder->join('tbl_satuan', 'tbl_satuan.id = tbl_obat.id_satuan');
        $builder->join('tbl_kategori', 'tbl_kategori.id = tbl_obat.id_kategori');

        $builder->where('tbl_temp.no_faktur', $no_faktur);
        $builder->orderBy('tbl_temp.detail_transaksi_id', 'asc');

        $query = $builder->get();

        return $query->getResultArray();
    }
}
