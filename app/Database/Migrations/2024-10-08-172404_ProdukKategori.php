<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ProdukKategori extends Migration
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
            'id_kategori' => [
                'type'           => 'INT',
                'constraint'     => '20',
                'null'           => true,
            ],
            'id_obat' => [
                'type'           => 'INT',
                'constraint'     => '20',
                'null'           => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('tbl_kategoriobat');
    }

    public function down()
    {
        $this->forge->dropTable('tbl_kategoriobat');
    }
}
