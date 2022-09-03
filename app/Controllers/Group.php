<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use Myth\Auth\Models\{GroupModel, PermissionModel};

class Group extends BaseController
{
    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->groups = new GroupModel();
        $this->permissions = new PermissionModel();
    }

    public function index()
    {
        return view('groups/index', [
            'groups' => $this->groups->findAll(),
        ]);
    }

    public function new()
    {
        return view('groups/new', [
            'permissions' => $this->permissions->findAll(),
        ]);
    }

    public function edit($id = null)
    {
        foreach ($this->groups->getPermissionsForGroup($id) as $value) {
            $permissionGroup[$value->id] = $value->name;
        }

        return view('groups/edit', [
            'group' => $this->groups->find($id),
            'permissions' => $this->permissions->findAll(),
            'permissionGroup' => $permissionGroup,
        ]);
    }

    public function create()
    {
        // dd($this->request->getPost());
        $this->db->transStart();
            $this->groups->insert([
                'name' => $this->request->getPost('name'),
                'description' => $this->request->getPost('description'),
            ]);

            $permissions = $this->request->getPost('permission');
            if (count($permissions) > 0) {
                foreach ($permissions as $value) {
                    $this->groups->addPermissionToGroup($value, $this->groups->getInsertId());
                }
            }
        $this->db->transComplete();

        return redirect()->to(site_url('group'));
    }

    public function update($id = null)
    {
        $this->db->transStart();
            $this->groups->update($id, [
                'name' => $this->request->getPost('name'),
                'description' => $this->request->getPost('description'),
            ]);

            $this->db->table('auth_groups_permissions')->where('group_id', $id)->delete();

            $permissions = $this->request->getPost('permission');
            if (count($permissions) > 0) {
                foreach ($permissions as $value) {
                    $this->groups->addPermissionToGroup($value, $id);
                }
            }
        $this->db->transComplete();

        return redirect()->to(site_url('group'));
    }
}
