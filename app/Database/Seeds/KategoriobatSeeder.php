<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class KategoriobatSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'id_kategori' => '1',
            'id_obat' => '1'
        ];
        $this->db->table('tbl_kategoriobat')->insert($data);
    }
}
