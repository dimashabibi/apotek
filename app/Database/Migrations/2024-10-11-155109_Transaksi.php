<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Transaksi extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'no_faktur' => [
                'type' => 'char',
                'constraint' => '20',
                'unsigned' => true,
                'auto_increment' => true

            ],
            'tgl_transaksi' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'jam' => [
                'type' => 'TIME',
                'null' => true,
            ],
            'diskon_persen' => [
                'type' => 'DECIMAL',
                'constraint' => '19, 2',
                'null' => true,
            ],
            'diskon_uang' => [
                'type' => 'DECIMAL',
                'constraint' => '19, 2',
                'null' => true,
            ],
            'total_kotor' => [
                'type' => 'DECIMAL',
                'constraint' => '19, 2',
                'null' => true,
            ],
            'total_bersih' => [
                'type' => 'DECIMAL',
                'constraint' => '19, 2',
                'null' => true,
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
