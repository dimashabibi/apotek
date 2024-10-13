<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PabrikSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'nama_pabrik'   => 'PT Farmasi Indonesia',
            'alamat_pabrik' => 'Sumbersari No 119 Rt 1 Rw 30',
            'kota'            => 'Malang',
            'no_telp'         => '098131232',
            'no_hp'           => '089839123',
            'no_rekening'     => '1232138',
            'npwp'            => 'Malang',

        ];
        $this->db->table('tbl_pabrik')->insert($data);
    }
}
