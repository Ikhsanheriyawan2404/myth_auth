<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class User extends BaseController
{
    public function __construct()
    {
        $this->users = new UserModel();
    }
    
    public function index()
    {
        return view('users/index', [
            'users' => $this->users->findAll(),
        ]);
    }
}
