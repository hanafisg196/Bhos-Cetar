<?php
namespace App\Services;

use Illuminate\Http\Request;

interface ScheduleService {
    public function createSchedule(Request $request);
    public function getAllSchedules($perPage);
    public function getUserId(Request $request);
    public function getSchedulesByid($id);
    public function getDetailSchedule($id);
    public function deleteSchedule($id);
    public function search($search,$perPage) ;
    public function readStatus($id);
    public function countUsualan();
    public function inboxCount();
    public function updateStatSchdeule($id, $stat,$message);
    public function download($file);
}
