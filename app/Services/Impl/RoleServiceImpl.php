<?php
namespace App\Services\Impl;

use App\Models\Role;
use App\Services\RoleService;

class RoleServiceImpl implements RoleService {

    public function getRole(){
        return Role::latest()->paginate(10);
    }
}
