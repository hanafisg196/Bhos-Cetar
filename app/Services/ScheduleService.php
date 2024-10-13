<?php
namespace App\Services;

use Illuminate\Http\Request;

interface ScheduleService {
    public function createSchedule(Request $request);
    public function updateSchedule(Request $request, $id);
    public function getAllSchedules($perPage);
    public function getUserId();
    public function getSchedulesByUser(Request $request);
    public function getDetailSchedule($id);
    public function deleteSchedule($id);
    public function deleteDocument($id);
    public function search($search,$perPage) ;
    public function readStatus($id);
    public function countUsulan();
    public function inboxCount();
    public function updateStatSchdeule($id, $stat,$message);
    public function download($file);
}
