<?php
namespace App\Services\Impl;

use App\Models\Notification;
use App\Services\NotificationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationServiceImpl implements NotificationService {

    public function getUserId()
    {
        return Auth::user()->id;
    }

    public function getNotify(Request $request) {
        $user = $this->getUserId();
        return Notification::where('user_id', $user)
        ->whereHas('schedules', function ($query) {
            $query->whereIn('status', ['Ditolak', 'Disetujui']);
        })
        ->orWhereHas('ranhams', function ($query) {
            $query->whereIn('status', ['Ditolak', 'Disetujui']);
        })->latest()->get();

    }

     public function updateNotifStat($id){
        $notif = Notification::find($id);
        $notif->update([
            'notif_read' => 1
        ]);
     }

    public function count(Request $request){
        $user = $this->getUserId();
        return Notification::where('user_id', $user->id)->where('notif_read', 0)->count();
    }


}

