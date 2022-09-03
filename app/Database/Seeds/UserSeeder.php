<?php

namespace App\Database\Seeds;

use App\Models\UserModel;
use CodeIgniter\Database\Seeder;
use Myth\Auth\Models\GroupModel;
use Myth\Auth\Password;

class UserSeeder extends Seeder
{
    public function run()
    {
        $users = new UserModel();
        $groups = new GroupModel();

        $users->insert([
            'username' => 'ikhsan123',
            'email' => 'ikhsan@gmail.com',
            'password_hash' => Password::hash('ikhsan24'),
            'active' => 1,
        ]);

        $groups->addUserToGroup($users->getInsertId(), 1);

        $users->insert([
            'username' => 'kuncoro123',
            'email' => 'kuncoro@gmail.com',
            'password_hash' => Password::hash('ikhsan123'),
            'active' => 1,
        ]);

        $groups->addUserToGroup($users->getInsertId(), 2);
    }
}
