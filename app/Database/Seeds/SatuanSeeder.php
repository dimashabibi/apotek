<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SatuanSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'nama_satuan' => 'PCS',
        ];
        $this->db->table('tbl_satuan')->insert($data);
    }
}
