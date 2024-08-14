<?php
namespace App\Services;

use Illuminate\Http\Request;

interface ScheduleService {
    public function createSchedule(Request $request);
    public function getAllSchedules();
    public function getUserId(Request $request);
    public function getSchedulesByid($id);
    public function getDetailSchedule($id);
}
