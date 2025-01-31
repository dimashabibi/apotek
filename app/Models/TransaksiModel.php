<?php

namespace App\Models;

use CodeIgniter\Database\MySQLi\Builder;
use CodeIgniter\Model;

use function PHPUnit\Framework\isNull;

class TransaksiModel extends Model
{
    protected $table            = 'tbl_transaksi';
    protected $primaryKey       = 'no_faktur';
    protected $useAutoIncrement = true;



    protected $allowedFields    = [
        'no_faktur',
        'tgl_transaksi',
        'jam',
        'diskon_persen',
        'nama_kasir',
        'diskon_uang',
        'total_kotor',
        'total_bersih',
        'jumlah_uang',
        'sisa_uang'
    ];

    protected $transaksiModel;

    public function getNoFaktur()
    {
        date_default_timezone_set('Asia/Jakarta');
        $tgl = date('Y-m-d'); // Tanggal saat ini
        $db = \Config\Database::connect();
        $builder = $db->table('tbl_transaksi');

        // Ambil nomor urut terakhir untuk tanggal saat ini
        $builder->select('RIGHT(tbl_transaksi.no_faktur, 3) as no_urut');
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

        $batas = str_pad($no, 3, "0", STR_PAD_LEFT);
        $kodeTampil = date('ymd') . $batas;

        return $kodeTampil;
    }

    public function getTotalTransaksi($namaUser = null, $startDate = null, $endDate = null)
    {

        $db      = \Config\Database::connect();
        $builder = $db->table('tbl_transaksi');
        $builder->select('COUNT(tbl_transaksi.no_faktur) as total_transaksi');
        if (!is_null($namaUser)) {
            $builder->where('nama_kasir', $namaUser);
        }

        if ($startDate && $endDate) {
            $builder->where('tgl_transaksi >=', $startDate)
                ->where('tgl_transaksi <=', $endDate);
        }

        $query   = $builder->get();
        $result  = $query->getResultArray();

        return !empty($result) ? $result[0]['total_transaksi'] : 0;
    }

    public function getGrandTotal($namaUser = null, $startDate = null, $endDate = null)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('tbl_transaksi');
        $builder->select('SUM(tbl_transaksi.total_bersih) as total_penghasilan');
        if (!is_null($namaUser)) {
            $builder->where('nama_kasir', $namaUser);
        }


        if ($startDate && $endDate) {
            $builder->where('tgl_transaksi >=', $startDate)
                ->where('tgl_transaksi <=', $endDate);
        }

        $query   = $builder->get();
        $result  = $query->getResultArray();

        return !empty($result) ? $result[0]['total_penghasilan'] : 0;
    }

    public function search($keyword, $namaUser = null, $startDate = null, $endDate = null)
    {
        // Start with base query
        $builder = $this->table('tbl_transaksi')
            ->like('no_faktur', $keyword)
            ->orlike('tgl_transaksi', $keyword);

        // If nama user is provided, add filter
        if ($namaUser) {
            $builder->where('nama_kasir', $namaUser);
        }

        // Add date filtering if both start and end dates are provided
        if ($startDate && $endDate) {
            $builder->where('tgl_transaksi >=', $startDate)
                ->where('tgl_transaksi <=', $endDate);
        }

        return $builder;
    }
}
