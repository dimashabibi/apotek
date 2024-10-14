<?php

namespace App\Models;

use CodeIgniter\Database\MySQLi\Builder;
use CodeIgniter\Model;

class TransaksiModel extends Model
{
    protected $table            = 'tbl_transaksi';
    protected $primaryKey       = 'no_faktur';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';



    protected $allowedFields    = ['no_faktur', 'tgl_transaksi', 'jam', 'diskon_persen', 'diskon_uang', 'total_kotor', 'total_bersih'];

    protected $transaksiModel;

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
        
        $batas = str_pad($no, 4, "0", STR_PAD_LEFT);
        $kodeTampil = date('Ymd') . $batas;

        return $kodeTampil;
    }

    public function getTemp($no_faktur)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('tbl_temp'); 

        $builder->select('tbl_temp.detail_transaksi_id as id, tbl_temp.id_obat as obat,tbl_obat.nama_obat as nama_obat, tbl_obat.barcode_obat as barcode_obat, tbl_temp.harga_pokok as harga_pokok, tbl_temp.harga_jual as harga_jual, tbl_temp.qty as qty, tbl_temp.sub_total as sub_total');
       
        $builder->join('tbl_obat', 'tbl_obat.id = tbl_temp.id_obat');
       
        $builder->where('tbl_temp.no_faktur', $no_faktur);
        $builder->orderBy('tbl_temp.detail_transaksi_id', 'asc');
       
        $query = $builder->get();

        return $query->getResultArray();
    }
}
