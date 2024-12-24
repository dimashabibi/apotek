<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TblHutang extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'no_hutang' => [
                'type'           => 'CHAR',
                'constraint'     => 11,
                'unsigned'       => true,
            ],
            'nama_distributor' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'total_hutang' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
            ],
            'is_paid' => [
                'type'       => 'BOOLEAN',
                'default'    => false,
            ],
            'created_at' => [
                'type'       => 'DATETIME',
                'null'       => true,
            ],
            'updated_at' => [
                'type'       => 'DATETIME',
                'null'       => true,
            ],
            'paid_at' => [
                'type'       => 'DATETIME',
                'null'       => true,
            ]
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('tbl_hutang');
    }

    public function down()
    {
        $this->forge->dropTable('tbl_hutang');
    }
}
