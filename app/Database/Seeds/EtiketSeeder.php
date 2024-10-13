<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class EtiketSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'nama_etiket'   => 'Setelah Makan, 3x1 sehari',
            'ket_etiket'    => 'Obat dapat diminum setelah makan 3 x 1 hari',
        ];
        $this->db->table('tbl_etiket')->insert($data);
    }
}
