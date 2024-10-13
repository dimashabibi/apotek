<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class TblobatSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'barcode_obat' => '675561253',
            'merk_obat' => 'BODE',
            'nama_obat' => 'bodrexin',
            'id_golongan' => '1',
            'id_kategori' => '1',
            'id_supplier' => '1',
            'id_pabrik' => '1',
            'stok_min' => '10',
            'stok_obat' => '200',
            'id_satuan' => '1',
            'harga_pokok' => '10000',
            'harga_jual' => '15000',
            'id_etiket' => '1',
        ];
        $this->db->table('tbl_obat')->insert($data);
    }
}
