<?php
namespace App\Services;

interface NotificationService{
   public function getNotify($perPage);
    public function count();
    public function updateNotifStat($id);
    public function getNotifyWithLimit();
}
