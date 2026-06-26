<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

/**
 * UserSeeder - Praktikum 4
 * Membuat data dummy user untuk keperluan login.
 * Jalankan: php spark db:seed UserSeeder
 */
class UserSeeder extends Seeder
{
    public function run()
    {
        $model = model('UserModel');
        $model->insert([
            'username'     => 'admin',
            'useremail'    => 'admin@email.com',
            'userpassword' => password_hash('admin123', PASSWORD_DEFAULT),
        ]);
    }
}
