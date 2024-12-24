<?php

namespace App\Models;

use CodeIgniter\Model;

class PembelianModel extends Model
{
    protected $table            = 'tbl_pembelian';
    protected $primaryKey       = 'id_pembelian';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['id_pembelian', 'tgl_pembelian', 'no_faktur', 'id_supplier', 'total_pembelian', 'deskripsi'];

    public function getNoPembelian()
    {

        $db = \Config\Database::connect();
        $builder = $db->table('tbl_pembelian');

        // Ambil nomor urut terakhir untuk tanggal saat ini
        $builder->select('RIGHT(tbl_pembelian.id_pembelian, 4) as no_urut');
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
        $kodeTampil = 'NP' .  $batas;

        return $kodeTampil;
    }
}
