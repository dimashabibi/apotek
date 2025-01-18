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
        $builder->select('
        tbl_detail_transaksi.*,
        tbl_obat.*,
        tbl_transaksi.*,
        tbl_kategori.nama_kategori,
        tbl_satuan.nama_satuan');

        $builder->join('tbl_obat', 'tbl_obat.id = tbl_detail_transaksi.id_obat');
        $builder->join('tbl_kategori', 'tbl_kategori.id = tbl_obat.id_kategori');
        $builder->join('tbl_satuan', 'tbl_satuan.id = tbl_obat.id_satuan');
        $builder->join('tbl_transaksi', 'tbl_transaksi.no_faktur = tbl_detail_transaksi.no_faktur');

        $query   = $builder->get();
        return $query->getResultArray();
    }

    public function getDetailFaktur($no_faktur)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('tbl_detail_transaksi');
        $builder->select('
        tbl_detail_transaksi.detail_transaksi_id, 
        tbl_detail_transaksi.no_faktur, 
        tbl_detail_transaksi.harga_pokok, 
        tbl_detail_transaksi.id_obat, 
        tbl_detail_transaksi.harga_jual, 
        tbl_detail_transaksi.qty, 
        tbl_detail_transaksi.sub_total, 
        tbl_obat.*, 
        tbl_transaksi.*, 
        tbl_kategori.nama_kategori, 
        tbl_satuan.nama_satuan');
        $builder->join('tbl_obat', 'tbl_obat.id = tbl_detail_transaksi.id_obat');
        $builder->join('tbl_kategori', 'tbl_kategori.id = tbl_obat.id_kategori');
        $builder->join('tbl_satuan', 'tbl_satuan.id = tbl_obat.id_satuan');
        $builder->join('tbl_transaksi', 'tbl_transaksi.no_faktur = tbl_detail_transaksi.no_faktur');
        $builder->where('tbl_transaksi.no_faktur', $no_faktur);
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

    public function getObatTerlaris($bulan = null)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('tbl_detail_transaksi');
        $builder->select('COUNT(tbl_detail_transaksi.detail_transaksi_id) as total_transaksi, 
                         SUM(tbl_detail_transaksi.qty) as total_qty, 
                         SUM(sub_total) as total, 
                         tbl_obat.id,
                         tbl_obat.kode_rak,
                         tbl_obat.barcode_obat,
                         tbl_obat.nama_obat,
                         tbl_obat.konsinyasi,
                         tbl_kategori.nama_kategori, 
                         tbl_satuan.nama_satuan');
        $builder->join('tbl_obat', 'tbl_obat.id=tbl_detail_transaksi.id_obat');
        $builder->join('tbl_kategori', 'tbl_kategori.id=tbl_obat.id_kategori');
        $builder->join('tbl_satuan', 'tbl_satuan.id=tbl_obat.id_satuan');
        $builder->join('tbl_transaksi', 'tbl_transaksi.no_faktur=tbl_detail_transaksi.no_faktur');

        if ($bulan !== null) {
            $builder->where('DATE_FORMAT(tbl_transaksi.tgl_transaksi, "%Y-%m")', $bulan);
        }

        $builder->groupBy([
            'tbl_obat.id',
            'tbl_obat.kode_rak',
            'tbl_obat.barcode_obat',
            'tbl_obat.nama_obat',
            'tbl_obat.konsinyasi',
            'tbl_kategori.nama_kategori',
            'tbl_satuan.nama_satuan'
        ]);
        $builder->orderBy('total_qty', 'DESC');
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function getTransaksiPerhari($hari = null)
    {
        date_default_timezone_set('Asia/Jakarta');
        $hari = $hari ?? date('Y-m-d');
        $db = \Config\Database::connect();
        $builder = $db->table('tbl_detail_transaksi');
        $builder->select('
        tbl_transaksi.no_faktur,
        tbl_transaksi.nama_kasir,
        tbl_transaksi.tgl_transaksi,
        tbl_transaksi.diskon_persen,
        tbl_transaksi.diskon_uang,
        tbl_transaksi.total_kotor,
        tbl_transaksi.total_bersih,
        tbl_obat.id as obat_id,
        tbl_obat.nama_obat,
        tbl_obat.kode_rak,
        tbl_obat.barcode_obat,
        tbl_kategori.nama_kategori,
        tbl_satuan.nama_satuan,
        tbl_detail_transaksi.harga_jual,
        tbl_detail_transaksi.qty,
        tbl_detail_transaksi.sub_total,
        SUM(tbl_detail_transaksi.qty) as total_qty,
        SUM(tbl_transaksi.total_kotor) as sum_total_kotor
        ');
        $builder->join('tbl_obat', 'tbl_obat.id=tbl_detail_transaksi.id_obat');
        $builder->join('tbl_transaksi', 'tbl_transaksi.no_faktur=tbl_detail_transaksi.no_faktur');
        $builder->join('tbl_kategori', 'tbl_kategori.id=tbl_obat.id_kategori');
        $builder->join('tbl_satuan', 'tbl_satuan.id=tbl_obat.id_satuan');
        $builder->groupBy([
            'tbl_transaksi.nama_kasir',
            'tbl_transaksi.no_faktur',
            'tbl_transaksi.total_kotor',
            'tbl_transaksi.total_bersih',
            'tbl_transaksi.diskon_uang',
            'tbl_transaksi.diskon_persen',
            'tbl_transaksi.tgl_transaksi',
            'tbl_obat.id',
            'tbl_obat.nama_obat',
            'tbl_obat.kode_rak',
            'tbl_obat.barcode_obat',
            'tbl_kategori.nama_kategori',
            'tbl_satuan.nama_satuan',
            'tbl_detail_transaksi.harga_jual',
            'tbl_detail_transaksi.qty',
            'tbl_detail_transaksi.sub_total',
        ]);
        // Optional: Add date filtering. Remove or modify as needed
        $builder->where('DATE(tbl_transaksi.tgl_transaksi)', $hari);
        $builder->orderBy('tbl_transaksi.no_faktur', 'ASC');
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function getTransaksiPerbulan($bulan = null)
    {
        $bulan = $bulan ?? date('Y-m');
        $db = \Config\Database::connect();
        $builder = $db->table('tbl_detail_transaksi');
        $builder->select('
        tbl_transaksi.no_faktur,
        tbl_transaksi.tgl_transaksi,
        tbl_transaksi.diskon_persen,
        tbl_transaksi.diskon_uang,
        tbl_transaksi.total_kotor,
        tbl_transaksi.total_bersih,
        tbl_obat.id as obat_id,
        tbl_obat.nama_obat,
        tbl_obat.kode_rak,
        tbl_obat.barcode_obat,
        tbl_kategori.nama_kategori,
        tbl_satuan.nama_satuan,
        tbl_detail_transaksi.harga_jual,
        tbl_detail_transaksi.qty,
        tbl_detail_transaksi.sub_total,
        SUM(tbl_detail_transaksi.qty) as total_qty,
        SUM(tbl_transaksi.total_kotor) as sum_total_kotor
    ');
        $builder->join('tbl_obat', 'tbl_obat.id=tbl_detail_transaksi.id_obat');
        $builder->join('tbl_transaksi', 'tbl_transaksi.no_faktur=tbl_detail_transaksi.no_faktur');
        $builder->join('tbl_kategori', 'tbl_kategori.id=tbl_obat.id_kategori');
        $builder->join('tbl_satuan', 'tbl_satuan.id=tbl_obat.id_satuan');
        $builder->groupBy([
            'tbl_transaksi.no_faktur',
            'tbl_transaksi.total_kotor',
            'tbl_transaksi.total_bersih',
            'tbl_transaksi.diskon_uang',
            'tbl_transaksi.diskon_persen',
            'tbl_transaksi.tgl_transaksi',
            'tbl_obat.id',
            'tbl_obat.nama_obat',
            'tbl_obat.kode_rak',
            'tbl_obat.barcode_obat',
            'tbl_kategori.nama_kategori',
            'tbl_satuan.nama_satuan',
            'tbl_detail_transaksi.harga_jual',
            'tbl_detail_transaksi.qty',
            'tbl_detail_transaksi.sub_total',
        ]);
        $builder->where('DATE_FORMAT(tbl_transaksi.tgl_transaksi, "%Y-%m")', $bulan);
        $builder->orderBy('tbl_transaksi.no_faktur', 'ASC');
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function getTransaksiPertahun($tahun = null)
    {
        $tahun = $tahun ?? date('Y');
        $db = \Config\Database::connect();
        $builder = $db->table('tbl_detail_transaksi');
        $builder->select('
        tbl_transaksi.no_faktur,
        tbl_transaksi.tgl_transaksi,
        tbl_transaksi.diskon_persen,
        tbl_transaksi.diskon_uang,
        tbl_transaksi.total_kotor,
        tbl_transaksi.total_bersih,
        tbl_obat.id as obat_id,
        tbl_obat.nama_obat,
        tbl_obat.kode_rak,
        tbl_obat.barcode_obat,
        tbl_kategori.nama_kategori,
        tbl_satuan.nama_satuan,
        tbl_detail_transaksi.harga_jual,
        tbl_detail_transaksi.qty,
        tbl_detail_transaksi.sub_total,
        SUM(tbl_detail_transaksi.qty) as total_qty,
    ');
        $builder->join('tbl_obat', 'tbl_obat.id=tbl_detail_transaksi.id_obat');
        $builder->join('tbl_transaksi', 'tbl_transaksi.no_faktur=tbl_detail_transaksi.no_faktur');
        $builder->join('tbl_kategori', 'tbl_kategori.id=tbl_obat.id_kategori');
        $builder->join('tbl_satuan', 'tbl_satuan.id=tbl_obat.id_satuan');
        $builder->groupBy([
            'tbl_transaksi.no_faktur',
            'tbl_transaksi.total_kotor',
            'tbl_transaksi.total_bersih',
            'tbl_transaksi.diskon_uang',
            'tbl_transaksi.diskon_persen',
            'tbl_transaksi.tgl_transaksi',
            'tbl_obat.id',
            'tbl_obat.nama_obat',
            'tbl_obat.kode_rak',
            'tbl_obat.barcode_obat',
            'tbl_kategori.nama_kategori',
            'tbl_satuan.nama_satuan',
            'tbl_detail_transaksi.harga_jual',
            'tbl_detail_transaksi.qty',
            'tbl_detail_transaksi.sub_total',
        ]);
        $builder->where('DATE_FORMAT(tbl_transaksi.tgl_transaksi, "%Y")', $tahun);
        $builder->orderBy('tbl_transaksi.no_faktur', 'ASC');
        $query = $builder->get();
        return $query->getResultArray();
    }
}
