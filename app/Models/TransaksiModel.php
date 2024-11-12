<?php

namespace App\Models;

use CodeIgniter\Database\MySQLi\Builder;
use CodeIgniter\Model;

class TransaksiModel extends Model
{
    protected $table            = 'tbl_transaksi';
    protected $primaryKey       = 'no_faktur';
    protected $useAutoIncrement = true;



    protected $allowedFields    = ['no_faktur', 'tgl_transaksi', 'jam', 'diskon_persen', 'nama_kasir', 'diskon_uang', 'total_kotor', 'total_bersih', 'jumlah_uang', 'sisa_uang'];

    protected $transaksiModel;

    public function getNoFaktur()
    {
        date_default_timezone_set('Asia/Jakarta');
        $tgl = date('Y-m-d'); // Tanggal saat ini
        $db = \Config\Database::connect();
        $builder = $db->table('tbl_transaksi');

        // Ambil nomor urut terakhir untuk tanggal saat ini
        $builder->select('RIGHT(tbl_transaksi.no_faktur, 4) as no_urut');
        $builder->where('tbl_transaksi.tgl_transaksi', $tgl);
        $builder->orderBy('no_urut', 'DESC');
        $builder->limit(1);
        $query = $builder->get();

        // Periksa apakah ada data untuk tanggal tersebut
        if ($query->getNumRows() > 0) {
            $data = $query->getRowArray();
            $no = intval($data['no_urut']) + 1; // Tambahkan 1 ke nomor urut terakhir
        } else {
            $no = 1; // Jika tidak ada data, mulai dengan 1
        }

        $batas = str_pad($no, 4, "0", STR_PAD_LEFT);
        $kodeTampil = date('Ymd') . $batas;

        return $kodeTampil;
    }

    public function getTransaksiPerhari()
    {
        date_default_timezone_set('Asia/Jakarta');
        $tgl = date('Y-m-d');
        $db      = \Config\Database::connect();
        $builder = $db->table('tbl_transaksi');
        $builder->select('DATE(tbl_transaksi.tgl_transaksi) as tanggal, SUM(total_bersih) as total_penghasilan');
        $builder->groupBy('DATE(tbl_transaksi.tgl_transaksi)');
        $builder->where('DATE(tbl_transaksi.tgl_transaksi)', $tgl);
        $query   = $builder->get();
        $result  = $query->getResultArray();

        return !empty($result) ? $result[0]['total_penghasilan'] : 0;
    }

    public function getTransaksiPerbulan()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('tbl_transaksi');
        $builder->select("DATE_FORMAT(tbl_transaksi.tgl_transaksi, '%Y-%m') as bulan, SUM(total_bersih) as total_penghasilan");
        $builder->groupBy("DATE_FORMAT(tbl_transaksi.tgl_transaksi, '%Y-%m')");
        $builder->where("DATE_FORMAT(tbl_transaksi.tgl_transaksi, '%Y-%m')", date('Y-m'));
        $query   = $builder->get();
        $result  = $query->getResultArray();

        return !empty($result) ? $result[0]['total_penghasilan'] : 0;
    }

    public function getTransaksiPertahun()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('tbl_transaksi');
        $builder->select("YEAR(tbl_transaksi.tgl_transaksi) as tahun, SUM(total_bersih) as total_penghasilan");
        $builder->groupBy("YEAR(tbl_transaksi.tgl_transaksi)");
        $builder->where("YEAR(tbl_transaksi.tgl_transaksi)", date('Y'));
        $query   = $builder->get();
        $result  = $query->getResultArray();

        return !empty($result) ? $result[0]['total_penghasilan'] : 0;
    }

    public function getTotalTransaksi($namaUser)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('tbl_transaksi');
        $builder->select('COUNT(tbl_transaksi.no_faktur) as total_transaksi');
        $builder->where('nama_kasir', $namaUser);
        $query   = $builder->get();
        $result  = $query->getResultArray();

        return !empty($result) ? $result[0]['total_transaksi'] : 0;
    }

    public function getGrandTotal($namaUser)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('tbl_transaksi');
        $builder->select('SUM(tbl_transaksi.total_bersih) as total_penghasilan');
        $builder->where('nama_kasir', $namaUser);
        $query   = $builder->get();
        $result  = $query->getResultArray();

        return !empty($result) ? $result[0]['total_penghasilan'] : 0;
    }

    public function search($keyword)
    {

        return $this->table('tbl_transaksi')->like('no_faktur', $keyword)->orlike('tgl_transaksi', $keyword);
    }
}
