<?php
namespace App\Services\Impl;

use App\Models\Notification;
use App\Services\NotificationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationServiceImpl implements NotificationService
{
    private function getUser()
    {
        return Auth::user();
    }

    public function getNotify(Request $request)
    {
        $user = $this->getUser();
        return Notification::where('user_id', $user->id)
            ->whereHas('schedules', function ($query) {
                $query->whereIn('status', ['Ditolak', 'Disetujui']);
            })
            ->orWhereHas('ranhams', function ($query) {
                $query->whereIn('status', ['Ditolak', 'Disetujui']);
            })
            ->orWhereHas('ecorrections', function ($query) {
                $query->whereIn('status', ['Ditolak', 'Disetujui']);
            })
            ->latest()
            ->get();
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
