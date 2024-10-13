<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class GolonganSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'nama_golongan'   => 'Obat Bebas',
            'ket_golongan'    => 'Obat bebas diperjual belikan',
        ];
        $this->db->table('tbl_golongan')->insert($data);
    }
}
