<?php

namespace App\Services;

use Illuminate\Http\Request;

interface RoleService{
    public function getEmployeeHasAccess();
    public function getRuleType();
    public function setRuleEmployee(Request $request);
    public function updateRuleEmployee(Request $request,$id);
    public function deleteRuleEmployee($id);
    public function kamiPeduliUploader();
    public function ecorrectionUploader();
    public function ecorrectionAdmin();
    public function getEmployee($code);
    public function getOpdEmployee();
    public function getVerifikatorTwo();
    public function disposisiAccess();
    public function userManagerAdmin();
    public function checkVerifikatorTwo();
}
