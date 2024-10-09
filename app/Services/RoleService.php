<?php

namespace App\Services;

use Illuminate\Http\Request;

interface RoleService{
    public function getRole();
    public function getEmployee();
    public function getRuleType();
    public function setRuleEmployee(Request $request);
}
