<?php
namespace App\Services\Impl;

use App\Models\Notification;
use App\Services\NotificationService;
use Illuminate\Support\Facades\Auth;

class NotificationServiceImpl implements NotificationService
{
    private function getUser()
    {
        return Auth::user();
    }

    public function getNotify($perPage)
    {
        $user = $this->getUser();
        return Notification::where('user_id', $user->id)
            ->whereHas('schedules', function ($query) use ($user) {
                $query->where('user_id', $user->id)->whereIn('status', ['Ditolak', 'Disetujui', 'Revisi']);
            })
            ->orWhereHas('ranhams', function ($query) use ($user) {
                $query->where('user_id', $user->id)->whereIn('status', ['Ditolak', 'Disetujui' , 'Revisi']);
            })
            ->orWhereHas('ecorrections', function ($query) use ($user) {
                $query->where('user_id', $user->id)->whereIn('status', ['Ditolak', 'Disetujui' , 'Revisi']);
            })
            ->latest()->paginate($perPage);
    }

    public function getNotifyWithLimit()
    {
        $user = $this->getUser();
        return Notification::where('user_id', $user->id)
            ->whereHas('schedules', function ($query) use ($user) {
                $query->where('user_id', $user->id)->whereIn('status', ['Ditolak', 'Disetujui', 'Revisi']);
            })
            ->orWhereHas('ranhams', function ($query) use ($user) {
                $query->where('user_id', $user->id)->whereIn('status', ['Ditolak', 'Disetujui' , 'Revisi']);
            })
            ->orWhereHas('ecorrections', function ($query) use ($user) {
                $query->where('user_id', $user->id)->whereIn('status', ['Ditolak', 'Disetujui' , 'Revisi']);
            })->latest()->limit(6);
    }

    public function updateNotifStat($id)
    {
        $notif = Notification::find($id);
        $notif->update([
            'notif_read' => 1,
        ]);
    }

    public function count()
    {
        $user = $this->getUser();
        return Notification::where('user_id', $user->id)
            ->where('notif_read', 0)
            ->count();
    }
}
