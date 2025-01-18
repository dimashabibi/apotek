<?php

namespace App\Models;

use CodeIgniter\Model;

class HutangModel extends Model
{
    protected $table            = 'tbl_hutang';
    protected $primaryKey       = 'id_hutang';
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;

    protected $allowedFields = [
        'id_hutang',
        'nama_distributor',
        'tanggal',
        'total_hutang',
        'sisa_hutang',
        'is_paid',
        'paid_at'
    ];

    public function markAsPaid($id)
    {
        date_default_timezone_set('Asia/Jakarta');
        return $this->update($id, [
            'is_paid' => true,
            'paid_at' => date('Y-m-d H:i:s'),
            'sisa_hutang' => '0',
        ]);
    }

    public function getNoHutang()
    {

        $db = \Config\Database::connect();
        $builder = $db->table('tbl_hutang');

        // Ambil nomor urut terakhir untuk tanggal saat ini
        $builder->select('RIGHT(tbl_hutang.id_hutang, 4) as no_urut');
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
        $kodeTampil = 'NH' .  $batas;

        return $kodeTampil;
    }
}
