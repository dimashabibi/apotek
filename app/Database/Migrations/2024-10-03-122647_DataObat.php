<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DataObat extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'barcode' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null'       => true,
            ],
            'nama_obat' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null'       => true,
            ],
            'stok_obat'       => [
                'type'       => 'DECIMAL',
                'constraint' => '10, 2',
                'null'       => true,
            ],
            'satuan'       => [
                'type'       => 'VARCHAR',
                'constraint' => '20',
                'null'       => true,
            ],
            'jenis_obat'       => [
                'type'       => 'VARCHAR',
                'constraint' => '10',
                'null'       => true,
            ],
            'id_kategori'       => [
                'type'       => 'INT',
                'constraint' => '20',
                'null'       => true,
            ],
            'merk_obat'       => [
                'type'       => 'VARCHAR',
                'constraint' => '25',
                'null'       => true,
            ],
            'harga_pokok'       => [
                'type'       => 'DECIMAL',
                'constraint' => '10, 2',
                'null'       => true,
            ],
            'harga_jual'       => [
                'type'       => 'DECIMAL',
                'constraint' => '10, 2',
                'null'       => true,
            ],
            'stok_min'       => [
                'type'       => 'DECIMAL',
                'constraint' => '10, 2',
                'null'       => true,
            ],
            'keterangan_obat'       => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null'       => true,
            ],
            'supplier'       => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null'       => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('tbl_obat');
    }

    public function down()
    {
        $this->forge->dropTable('tbl_obat');
    }
}
