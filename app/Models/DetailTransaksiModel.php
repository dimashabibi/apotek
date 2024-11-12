<?php

namespace App\Models;

use CodeIgniter\Model;

class DetailTransaksiModel extends Model
{
    protected $table            = 'tbl_detail_transaksi';
    protected $primaryKey       = 'detail_transaksi_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['detail_transaksi_id', 'no_faktur', 'id_obat', 'harga_pokok', 'harga_jual', 'qty', 'sub_total'];


    public function getDetailTransaksi()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('tbl_detail_transaksi');
        $builder->select('tbl_detail_transaksi.*,tbl_obat.*, tbl_transaksi.*, tbl_kategori.nama_kategori, tbl_satuan.nama_satuan');
        $builder->join('tbl_obat', 'tbl_obat.id = tbl_detail_transaksi.id_obat');
        $builder->join('tbl_kategori', 'tbl_kategori.id = tbl_obat.id_kategori');
        $builder->join('tbl_satuan', 'tbl_satuan.id = tbl_obat.id_satuan');
        $builder->join('tbl_transaksi', 'tbl_transaksi.no_faktur = tbl_detail_transaksi.no_faktur');
        $query   = $builder->get();
        return $query->getResultArray();
    }

    public function getDetailFaktur()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('tbl_detail_transaksi');
        $builder->select('tbl_detail_transaksi.*, tbl_obat.*, tbl_transaksi.*, tbl_kategori.nama_kategori, tbl_satuan.nama_satuan');
        $builder->join('tbl_obat', 'tbl_obat.id = tbl_detail_transaksi.id_obat');
        $builder->join('tbl_kategori', 'tbl_kategori.id = tbl_obat.id_kategori');
        $builder->join('tbl_satuan', 'tbl_satuan.id = tbl_obat.id_satuan');
        $builder->join('tbl_transaksi', 'tbl_transaksi.no_faktur = tbl_detail_transaksi.no_faktur');
        $query = $builder->get();

        return $query->getResultArray();
    }


    public function getKategoriObat()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('tbl_detail_transaksi');
        $builder->select('COUNT(tbl_detail_transaksi.detail_transaksi_id) AS jumlah, tbl_kategori.nama_kategori AS kategori');
        $builder->join('tbl_obat', 'tbl_obat.id = tbl_detail_transaksi.id_obat');
        $builder->join('tbl_kategori', 'tbl_kategori.id = tbl_obat.id_kategori');
        $builder->groupBy('tbl_obat.id_kategori');
        $query   = $builder->get();
        return $query->getResultArray();
    }

    public function getDataTransaksi()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('tbl_detail_transaksi');
        $builder->select('MONTH(tbl_transaksi.tgl_transaksi) as bulan, SUM(sub_total) as jumlah');
        $builder->join('tbl_transaksi', 'tbl_transaksi.no_faktur = tbl_detail_transaksi.no_faktur');
        $builder->groupBy('MONTH(tbl_transaksi.tgl_transaksi)');
        $builder->orderBy('MONTH(tbl_transaksi.tgl_transaksi)', 'ASC');
        $query   = $builder->get();

        return $query->getResultArray();
    }

    public function getInvoice($no_faktur = false)
    {
        if ($no_faktur == false) {
            return $this->join('tbl_transaksi', 'tbl_transaksi.no_faktur = tbl_detail_transaksi.no_faktur')
                ->join('tbl_obat', 'tbl_obat.id = tbl_detail_transaksi.id_obat')
                ->join('tbl_kategori', 'tbl_kategori.id = tbl_obat.id_kategori')
                ->join('tbl_satuan', 'tbl_satuan.id = tbl_obat.id_satuan')
                ->findAll();
        }
        return $this->where(['tbl_detail_transaksi.no_faktur' => $no_faktur])
            ->join('tbl_transaksi', 'tbl_transaksi.no_faktur = tbl_detail_transaksi.no_faktur')
            ->join('tbl_obat', 'tbl_obat.id = tbl_detail_transaksi.id_obat')
            ->join('tbl_kategori', 'tbl_kategori.id = tbl_obat.id_kategori')
            ->join('tbl_satuan', 'tbl_satuan.id = tbl_obat.id_satuan')
            ->first();
    }

    public function getObatTerlaris()
    {

        $db      = \Config\Database::connect();
        $builder = $db->table('tbl_detail_transaksi');
        $builder->select('COUNT(tbl_detail_transaksi.detail_transaksi_id) as total_transaksi, SUM(tbl_detail_transaksi.qty) as total_qty, SUM(sub_total) as total, tbl_obat.*, tbl_kategori.nama_kategori, tbl_satuan.nama_satuan');
        $builder->join('tbl_obat', 'tbl_obat.id=tbl_detail_transaksi.id_obat');
        $builder->join('tbl_kategori', 'tbl_kategori.id=tbl_obat.id_kategori');
        $builder->join('tbl_satuan', 'tbl_satuan.id=tbl_obat.id_satuan');
        $builder->groupBy('tbl_detail_transaksi.id_obat');
        $builder->orderBy('total_qty', 'DESC');
        $query   = $builder->get();

        return $query->getResultArray();
    }

    public function getTransaksiPerhari()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('tbl_detail_transaksi');
        $builder->select('tbl_obat.id, tbl_obat.nama_obat, tbl_obat.kode_rak, tbl_obat.barcode_obat, tbl_obat.merk_obat, tbl_obat.konsinyasi, tbl_obat.harga_jual, tbl_kategori.nama_kategori, tbl_satuan.nama_satuan, tbl_transaksi.no_faktur, tbl_transaksi.tgl_transaksi');

        $builder->join('tbl_obat', 'tbl_obat.id=tbl_detail_transaksi.id_obat');
        $builder->join('tbl_transaksi', 'tbl_transaksi.no_faktur=tbl_detail_transaksi.no_faktur ');
        $builder->join('tbl_kategori', 'tbl_kategori.id=tbl_obat.id_kategori');
        $builder->join('tbl_satuan', 'tbl_satuan.id=tbl_obat.id_satuan');
        $builder->where('SUBSTR(tbl_transaksi.tgl_transaksi, 1, 10)=', 'DATE(NOW())', false);

        $query = $builder->get();

        return $query->getResultArray();
    }
}
