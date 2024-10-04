<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class TblobatSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'barcode' => '675561253',
            'nama_obat' => 'bodrex batuk',
            'stok_obat' => '50',
            'satuan' => 'TABLET',
            'jenis_obat' => 'BEBAS',
            'kategori_obat' => 'BATUK/PILEK',
            'merk_obat' => 'BODE',
            'harga_pokok' => '1.000',
            'harga_jual' => '2.471',
            'stok_min' => '10',
            'keterangan_obat' => 'obat batuk berdahak',
            'supplier' => 'PT JAKSA AGUNG',
        ];
        $this->db->table('tbl_obat')->insert($data);
    }
}
