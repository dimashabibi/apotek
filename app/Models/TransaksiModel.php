<?php

namespace App\Models;

use CodeIgniter\Database\MySQLi\Builder;
use CodeIgniter\Model;

class TransaksiModel extends Model
{
    protected $table            = 'tbl_transaksi';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';

    protected $allowedFields    = ['no_faktur', 'tgl_transaksi', 'jam', 'grand_total', 'dibayar', 'kembalian', 'id_kasir'];


    public function getNoFaktur()
    {
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

        // Buat nomor faktur dengan format YYYYMMDD + nomor urut
        $batas = str_pad($no, 4, "0", STR_PAD_LEFT); // Tambahkan padding nol jika diperlukan
        $kodeTampil = date('Ymd') . $batas;

        return $kodeTampil;
    }

   
}
