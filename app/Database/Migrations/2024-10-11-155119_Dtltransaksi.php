<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Dtltransaksi extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'detail_transaksi_id' => [
                'type' => 'bigint',
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
                'type' => 'decimal',
                'constraint' => '19, 2',
                'null' => true,
            ],
            'sub_total' => [
                'type' => 'DECIMAL',
                'constraint' => '19, 2',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('no_faktur', 'tbl_transaksi', 'no_faktur', 'cascade');
        $this->forge->addForeignKey('id_obat', 'tbl_obat', 'id', 'cascade');
        $this->forge->createTable('tbl_detail_transaksi');
    }

    public function down()
    {
        $this->forge->dropTable('tbl_detail_transaksi');
    }
}
