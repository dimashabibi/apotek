<?php

namespace App\Models;

use CodeIgniter\Model;

class TempPembelianModel extends Model
{
    protected $table            = 'tbl_temp_pembelian';
    protected $primaryKey       = 'detail_pembelian_id';
    protected $useAutoIncrement = true;

    protected $allowedFields    = ['detail_pembelian_id', 'id_pembelian', 'id_obat', 'harga_pokok', 'qty', 'sub_total'];

    public function getTempPembelian($id_pembelian)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('tbl_temp_pembelian');

        $builder->select('tbl_temp_pembelian.detail_pembelian_id as id, tbl_temp_pembelian.id_obat as obat, tbl_obat.kode_rak as kode_rak, tbl_obat.nama_obat as nama_obat, tbl_obat.barcode_obat as barcode_obat, tbl_obat.id_satuan as nama_satuan, tbl_obat.id_kategori as nama_kategori,  tbl_temp_pembelian.harga_pokok as harga_pokok, tbl_temp_pembelian.qty as qty, tbl_temp_pembelian.sub_total as sub_total, tbl_satuan.nama_satuan, tbl_kategori.nama_kategori');
        $builder->join('tbl_obat', 'tbl_obat.id = tbl_temp_pembelian.id_obat');
        $builder->join('tbl_satuan', 'tbl_satuan.id = tbl_obat.id_satuan');
        $builder->join('tbl_kategori', 'tbl_kategori.id = tbl_obat.id_kategori');

        $builder->where('tbl_temp_pembelian.id_pembelian', $id_pembelian);
        $builder->orderBy('tbl_temp_pembelian.detail_pembelian_id', 'asc');

        $query = $builder->get();

        return $query->getResultArray();
    }
}
