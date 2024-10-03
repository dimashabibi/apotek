<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class TblobatSeeder extends Seeder
{
    public function run()
    {
        $data = [

        ];
        $this->db->table('tbl_obat')->insert($data);
    }
}
