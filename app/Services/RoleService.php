<?php

namespace App\Services;

use Illuminate\Http\Request;

interface RoleService{
    public function getRole();
    public function getEmployee();
    public function getRuleType();
    public function setRuleEmployee(Request $request);
    public function updateRuleEmployee(Request $request,$id);
    public function deleteRuleEmployee($id);
    public function kamiPeduliUploader(Request $request);
    public function ecorrectionUploader(Request $request);
    public function ecorrectionAdmin( $request);
}
