<?php
namespace App\Services;

use Illuminate\Http\Request;

interface NotificationService{
    public function getNotify();
    public function count();
    public function updateNotifStat($id);
}
