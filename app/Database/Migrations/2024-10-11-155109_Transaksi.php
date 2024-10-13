<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Transaksi extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => '11',
                'unsigned' => true,
                'auto_increment' => true

            ],
            'no_faktur' => [
                'type' => 'VARCHAR',
                'constraint' => '15',
                'null' => true,

            ],
            'tgl_transaksi' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'jam' => [
                'type' => 'TIME',
                'null' => true,
            ],
            'grand_total' => [
                'type' => 'DECIMAL',
                'constraint' => '19, 2',
                'null' => true,
            ],
            'dibayar' => [
                'type' => 'DECIMAL',
                'constraint' => '19, 2',
                'null' => true,
            ],
            'kembalian' => [
                'type' => 'DECIMAL',
                'constraint' => '19, 2',
                'null' => true,
            ],
            'id_kasir' => [
                'type' => 'INT',
                'constraint' => '11',
            ],
        ]);
        $this->forge->addKey(['id', true]);
        $this->forge->createTable('tbl_transaksi');
    }

    public function down()
    {
        $this->forge->dropTable('tbl_transaksi');
    }
}
