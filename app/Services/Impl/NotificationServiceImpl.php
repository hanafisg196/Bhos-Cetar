<?php
namespace App\Services\Impl;

use App\Models\Notification;
use App\Services\NotificationService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class NotificationServiceImpl implements NotificationService {



    public function getNotify(Request $request) {

        $user = $request->session()->get('user');
        $user_id = $user['pegawai']['nip'];
        return Notification::where('user_id', $user_id)
        ->whereHas('schedules', function ($query) {
            $query->whereIn('status', ['Ditolak', 'Disetujui']);
        })
        ->orWhereHas('ranhams', function ($query) {
            $query->whereIn('status', ['Ditolak', 'Disetujui']);
        })
        ->get();

    }

     public function updateNotifStat($id){
        $notif = Notification::find($id);
        $notif->update([
            'notif_read' => 1
        ]);
     }

    public function count(Request $request){
        $user = $request->session()->get('user');
        $user_id = $user['pegawai']['nip'];
        return Notification::where('user_id', $user_id)->where('notif_read', 0)->count();
    }


}

