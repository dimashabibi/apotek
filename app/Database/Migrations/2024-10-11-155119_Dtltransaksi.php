<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Dtltransaksi extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => '11',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'no_faktur' => [
                'type' => 'VARCHAR',
                'constraint' => '15',
                'null' => true,
            ],
            'barcode' => [
                'type' => 'VARCHAR',
                'constraint' => '25',
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
            'total_harga' => [
                'type' => 'DECIMAL',
                'constraint' => '19, 2',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('tbl_detail_transaksi');
    }

    public function down()
    {
        $this->forge->dropTable('tbl_detail_transaksi');
    }
}
