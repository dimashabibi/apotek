<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TempPenjualan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'detail_transaksi_id' => [
                'type' => 'INT',
                'constraint' => '11',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'no_faktur' => [
                'type' => 'char',
                'constraint' => '20',
                'null' => true,
            ],
            'id_obat' => [
                'type' => 'char',
                'constraint' => '50',
                'null' => true,
            ],
            'harga_pokok' => [
                'type' => 'DECIMAL',
                'constraint' => '19, 2',
                'null' => true,
            ],
            'harga_jual' => [
                'type' => 'DECIMAL',
                'constraint' => '19, 2',
                'null' => true,
            ],
            'qty' => [
                'type' => 'INT',
                'constraint' => '11',
                'null' => true,
            ],
            'sub_total' => [
                'type' => 'DECIMAL',
                'constraint' => '19, 2',
                'null' => true,
            ]
        ]);

        $this->forge->addPrimaryKey('detail_transaksi_id');
        $this->forge->createTable('temporary');
    }

    public function down()
    {
        $this->forge->dropTable('temporary');
    }
}
