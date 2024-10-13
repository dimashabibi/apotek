<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Supplier extends Migration
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
            'nama_supplier' => [
                'type'           => 'VARCHAR',
                'constraint'     => '150',
                'null'           => true,
            ],
            'alamat_supplier' => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
                'null'           => true,
            ],
            'kota' => [
                'type'           => 'VARCHAR',
                'constraint'     => '50',
                'null'           => true,
            ],
            'no_telp' => [
                'type'           => 'int',
                'constraint'     => '150',
                'null'           => true,
            ],
            'no_hp' => [
                'type'           => 'int',
                'constraint'     => '150',
                'null'           => true,
            ],
            'no_rekening' => [
                'type'           => 'int',
                'constraint'     => '255',
                'null'           => true,
            ],
            'npwp' => [
                'type'           => 'int',
                'constraint'     => '255',
                'null'           => true,
            ],
            'ket_supplier' => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
                'null'           => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('tbl_supplier');
    }

    public function down()
    {
        $this->forge->dropTable('tbl_supplier');
    }
}
