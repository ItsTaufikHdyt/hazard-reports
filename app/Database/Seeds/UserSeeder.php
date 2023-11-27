<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'id' => 1,
            'username' => 'admin',
            'password'    => password_hash('admin123', PASSWORD_BCRYPT),
            'name'    => 'Admin 1',
            'role'    => '1',
        ];

        // Using Query Builder
        $this->db->table('users')->insert($data);
    }
}
