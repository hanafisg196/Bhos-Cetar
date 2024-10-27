<?php
namespace App\Services;

use Illuminate\Http\Request;

interface ScheduleService {
    public function createSchedule(Request $request);
    public function updateSchedule(Request $request, $id);
    public function getAllSchedules($perPage);
    public function getUser();
    public function getSchedulesByUser(Request $request);
    public function getDetailSchedule($id);
    public function deleteSchedule($id);
    public function deleteDocument($id);
    public function search($search,$perPage) ;
    public function readStatus($id);
    public function countUsulan();
    public function inboxCount();
    public function updateStatSchdeule($id, $stat,$message);
    public function sendToVerifikatorOne($id, $verifikator);
    public function download($file);
    public function ususlanLbh($perPage);
    public function disposisiLbh($perPage);
    public function ditolakLbh($perPage);
    public function disetujuiLbh($perPage);
    public function revisiLbh($perPage);
    public function disposisiByVerifikator($perPage);
    public function ditolakByVerifikator($perPage);
    public function disetujuiByVerifikator($perPage);
    public function revisiByVerifikator($perPage);
    public function countReadLbhAll();
    public function countReadLbhUsulan();
    public function countLbhDisposisi();
    public function countReadLbhDisposisiByVerfikator();
    public function countLbhDitolak();
    public function countLbhDisetujui();
    public function countLbhRevisi();
    public function countReadLbhRevisiByVerfikator();
    public function countLbhDitolakByVerfikator();
    public function countLbhDisetujuiByVerfikator();
    public function tracking($postId);


}
