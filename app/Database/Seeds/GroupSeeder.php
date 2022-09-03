<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Myth\Auth\Models\{PermissionModel, GroupModel};

class GroupSeeder extends Seeder
{
    public function run()
    {
        $groups = new GroupModel();
        $groups->insert([
            'name' => 'Superadmin',
            'description' => 'Level Dewa',
        ]);

        $groups->insert([
            'name' => 'Admin',
            'description' => 'Level Raja',
        ]);

        $permissions = new PermissionModel();
        $superadmin = $permissions->findAll();
        foreach ($superadmin as $permission) {
            $groups->addPermissionToGroup($permission->id, 1);
        }

        $admin = $permissions->where('name', 'user-module')->get()->getFirstRow();
        $groups->addPermissionToGroup($admin->id, 2);
    }
}
