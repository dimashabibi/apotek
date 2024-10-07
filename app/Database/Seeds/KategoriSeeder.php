<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class KategoriSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'nama_kategori' => 'obat dewasa',
        ];
        $this->db->table('tbl_kategori')->insert($data);
    }
}
