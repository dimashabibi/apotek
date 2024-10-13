<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Etiket extends Migration
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
            'nama_etiket' => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
                'null'           => true,
            ],
            'ket_etiket' => [
                'type'           => 'VARCHAR',
                'constraint'     => '155',
                'null'           => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('tbl_etiket');
    }

    public function down()
    {
        $this->forge->dropTable('tbl_etiket');
    }
}
