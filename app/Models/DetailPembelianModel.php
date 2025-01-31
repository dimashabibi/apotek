<?php

namespace App\Models;

use CodeIgniter\Model;

class DetailPembelianModel extends Model
{
    protected $table            = 'tbl_detail_pembelian';
    protected $primaryKey       = 'detail_pembelian_id';
    protected $useAutoIncrement = true;

    protected $allowedFields    = ['detail_pembelian_id', 'id_pembelian', 'no_faktur', 'id_supplier', 'id_obat', 'harga_pokok', 'qty', 'sub_total'];


    public function getPembelianPerbulan($bulan = null)
    {
        $bulan = $bulan ?? date('Y-m');
        $db = \Config\Database::connect();
        $builder = $db->table('tbl_detail_pembelian');
        $builder->select('
        tbl_pembelian.id_pembelian,
        tbl_pembelian.tgl_pembelian,
        tbl_pembelian.id_supplier,
        tbl_obat.id as obat_id,
        tbl_obat.nama_obat,
        tbl_obat.kode_rak,
        tbl_obat.barcode_obat,
        tbl_kategori.nama_kategori,
        tbl_satuan.nama_satuan,
        tbl_supplier.nama_supplier,
        tbl_detail_pembelian.harga_pokok,
        tbl_detail_pembelian.qty,
        tbl_detail_pembelian.sub_total,
        SUM(tbl_detail_pembelian.qty) as total_qty,
        SUM(tbl_detail_pembelian.qty * tbl_detail_pembelian.harga_pokok) as total_pembelian
    ');
        $builder->join('tbl_obat', 'tbl_obat.id=tbl_detail_pembelian.id_obat');
        $builder->join('tbl_pembelian', 'tbl_pembelian.id_pembelian=tbl_detail_pembelian.id_pembelian');
        $builder->join('tbl_supplier', 'tbl_supplier.id=tbl_pembelian.id_supplier');
        $builder->join('tbl_kategori', 'tbl_kategori.id=tbl_obat.id_kategori');
        $builder->join('tbl_satuan', 'tbl_satuan.id=tbl_obat.id_satuan');
        $builder->groupBy([
            'tbl_pembelian.id_pembelian',
            'tbl_pembelian.tgl_pembelian',
            'tbl_obat.id',
            'tbl_obat.nama_obat',
            'tbl_obat.kode_rak',
            'tbl_obat.barcode_obat',
            'tbl_kategori.nama_kategori',
            'tbl_satuan.nama_satuan',
            'tbl_supplier.nama_supplier',
            'tbl_detail_pembelian.harga_pokok',
            'tbl_detail_pembelian.qty',
            'tbl_detail_pembelian.sub_total',
        ]);
        $builder->where('DATE_FORMAT(tbl_pembelian.tgl_pembelian, "%Y-%m")', $bulan);
        $builder->orderBy('tbl_pembelian.id_pembelian', 'ASC');
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function getDetailPembelian($id)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('tbl_detail_pembelian');
        $builder->select('
        tbl_pembelian.*,
        tbl_obat.*,
        tbl_obat.barcode_obat,
        tbl_kategori.nama_kategori,
        tbl_satuan.nama_satuan,
        tbl_supplier.nama_supplier,
        tbl_detail_pembelian.harga_pokok,
        tbl_detail_pembelian.qty,
        tbl_detail_pembelian.sub_total,
        tbl_detail_pembelian.detail_pembelian_id,
    ');
        $builder->join('tbl_obat', 'tbl_obat.id=tbl_detail_pembelian.id_obat');
        $builder->join('tbl_pembelian', 'tbl_pembelian.id_pembelian=tbl_detail_pembelian.id_pembelian');
        $builder->join('tbl_supplier', 'tbl_supplier.id=tbl_pembelian.id_supplier');
        $builder->join('tbl_kategori', 'tbl_kategori.id=tbl_obat.id_kategori');
        $builder->join('tbl_satuan', 'tbl_satuan.id=tbl_obat.id_satuan');

        $builder->where('tbl_detail_pembelian.id_pembelian', $id);
        $query = $builder->get();
        return $query->getResultArray();
    }
}
