<?php
namespace App\Services;

use Illuminate\Http\Request;

interface NotificationService{
    public function getNotify(Request $request);
    public function count(Request $request);
    public function updateNotifStat($id);
}
