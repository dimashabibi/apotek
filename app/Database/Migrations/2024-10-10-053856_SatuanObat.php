<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SatuanObat extends Migration
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
            'nama_satuan' => [
                'type'           => 'VARCHAR',
                'constraint'     => '50',
                'null'           => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('tbl_satuan');
    }

    public function down()
    {
        $this->forge->dropTable('tbl_satuan');
    }
}
