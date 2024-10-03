<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'nama_user' => 'admin',
            'username' => 'admin',
            'password' => password_hash('admin', PASSWORD_BCRYPT),

        ];
        $this->db->table('user')->insert($data);
    }
}
