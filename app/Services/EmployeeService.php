<?php
namespace App\Services;
interface EmployeeService {

    //fetch employee api method
    public function getEmployee($code);
    public function getEmployeeDataByCode($code);
    public function getKabagTata();
}
