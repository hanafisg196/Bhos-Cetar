<?php
namespace App\Services\Impl;

use App\Models\CategoryRanhamn;
use App\Models\Kkp;
use App\Models\Notification;
use App\Models\Ranham;
use App\Models\TrackingPoint;
use App\Services\ReportHamService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportHamServiceImpl implements ReportHamService
{
    private function getCatRanId()
    {
        $now = Carbon::now();

        $maret = Carbon::createFromDate(null, 3, 1);
        $april = Carbon::createFromDate(null, 4, 30);

        $juli = Carbon::createFromDate(null, 7, 1);
        $agustus = Carbon::createFromDate(null, 8, 31);

        $november = Carbon::createFromDate(null, 11, 1);
        $december = Carbon::createFromDate(null, 12, 31);

        if ($now->between($maret, $april)) {
            $val = 1;
        } elseif ($now->between($juli, $agustus)) {
            $val = 2;
        } elseif ($now->between($november, $december)) {
            $val = 3;
        } else {
            $val = null;
        }

        return $val;
    }
    private function createTrackingPointLah($id, $status, $nip)
    {
        TrackingPoint::create([
            'lah_id' => $id,
            'status' => $status,
            'verifikator_nip' => $nip,
        ]);
    }
    public function getUser()
    {
        return Auth::user();
    }
    private function getUserRole($rule)
    {
        return Auth::user()->rules->pluck('nama')->intersect($rule)->isNotEmpty();
    }
    public function getRanhamByid($id)
    {
        return Ranham::find($id);
    }
    public function generateCode()
    {
        $prefix = 'LAH';
        $randomNumber = mt_rand(10000, 99999);
        return $prefix . $randomNumber;
    }
    public function getKkp()
    {
        return Kkp::latest()->get();
    }

    public function getRanhamByUser(Request $request)
    {
        $user = $this->getUser();
        return Ranham::where('user_id', $user->id)
            ->latest('updated_at')
            ->paginate(10, ['*'], 'aksi-ham-page');
    }

    public function getRanhamAll($perPage)
    {
        return Ranham::latest('updated_at')->paginate($perPage);
    }

    public function saveRanham(Request $request)
    {
        $user = $this->getUser();
        $validated = $request->validate([
            'link' => 'required|url',
            'kkp' => 'required',
        ]);
        $ranham = Ranham::create([
            'link' => $validated['link'],
            'kkp_id' => $validated['kkp'],
            'user_id' => $user->id,
            'name' => $user->name,
            'code' => $this->generateCode(),
            'catran_id' => $this->getCatRanId(),
        ]);
        $ranham->refresh();
        $this->createTrackingPointLah($ranham->id, $ranham->status, null);
    }
    public function updateStatRanham($id, $stat, $message)
    {
        $update = Ranham::where('id', $id)->update([
            'status' => $stat,
            'message' => $message,
        ]);

        if ($update) {
            $ranham = Ranham::find($id);
            $notif = Notification::where('lah_id', $id)->first();
            if (!$notif) {
                Notification::create([
                    'user_id' => $ranham->user_id,
                    'lah_id' => $id,
                    'created_at' => Carbon::now(),
                    'notif_read' => 0,
                ]);
            } else {
                $notif->update([
                    'user_id' => $ranham->user_id,
                    'lah_id' => $id,
                    'created_at' => Carbon::now(),
                    'notif_read' => 0,
                ]);
            }
            $ranham->refresh();
            $this->createTrackingPointLah(
               $ranham->id,
               $ranham->status,
               $ranham->verifikator_nip);
        }
    }
    public function updateRanham(Request $request, $id)
    {
        $ranham = Ranham::find($id);
        $validated = $request->validate([
            'link' => 'required|active_url',
            'kkp_id' => 'required',
        ]);
        $ranham->update([
            'link' => $validated['link'],
            'kkp_id' => $validated['kkp_id'],
            'status' => 'Revisi',
            'read' => 0
        ]);
        $ranham->refresh();
        $this->createTrackingPointLah(
           $ranham->id,
           $ranham->status,
           $ranham->verifikator_nip);
    }

    public function search($search, $perPage)
    {
        return Ranham::where('name', 'like', '%' . $search . '%')->paginate($perPage);
    }

    public function searchByUser(Request $request, $search)
    {
        $user = $this->getUser();
        return Ranham::where('name', 'like', '%' . $search . '%')
            ->where('user_id', $user->id)
            ->latest()
            ->paginate(5);
    }

    public function readStatus($id)
    {
        $accessRule = ['ADMIN', 'KABAG'];
        $stat = ['Revisi', 'Ditolak', 'Disetujui', 'Disposisi'];
        $rule = $this->getUserRole($accessRule);
        $data = Ranham::find($id);
        $allowedStat = in_array($data->status, $stat);
        if ($rule === true && $allowedStat === true) {
            'baca mantra , skidipapap yehe yehe';
        } else {
            $data->update([
                'read' => 1,
            ]);
        }
    }

    public function sendToVerifikatorOne($id, $verifikator)
    {
        $lbh = $this->getRanhamByid($id);
        $lbh->update([
            'verifikator_nip' => $verifikator,
            'status' => 'Disposisi',
            'read' => 0,
        ]);

        $lbh->refresh();
        $this->createTrackingPointLah(
           $lbh->id,
           $lbh->status,
           $lbh->verifikator_nip);
    }

    public function inboxCount()
    {
        return Ranham::where('read', 0)->count();
    }

    public function lisCatRan()
    {
        return CategoryRanhamn::get();
    }

    public function getDataByCatRan($catRan, $perPage)
    {
        return Ranham::where('catran_id', $catRan)->latest('updated_at')->paginate($perPage);
    }

    public function ususlanLah($perPage)
    {
        return Ranham::where('status', 'Usulan')->latest()->paginate($perPage);
    }
    public function disposisiLah($perPage)
    {
        return Ranham::where('status', 'Disposisi')->latest()->paginate($perPage);
    }
    public function ditolakLah($perPage)
    {
        return Ranham::where('status', 'Ditolak')->latest()->paginate($perPage);
    }
    public function disetujuiLah($perPage)
    {
        return Ranham::where('status', 'Disetujui')->latest()->paginate($perPage);
    }
    public function revisiLah($perPage)
    {
        return Ranham::where('status', 'Revisi')->latest()->paginate($perPage);
    }
    public function disposisiByVerifikator($perPage)
    {
        $user = $this->getUser();
        return Ranham::where('verifikator_nip', $user->nip)
            ->where('status', 'Disposisi')
            ->latest()
            ->paginate($perPage);
    }
    public function ditolakByVerifikator($perPage)
    {
        $user = $this->getUser();
        return Ranham::where('verifikator_nip', $user->nip)
            ->where('status', 'Ditolak')
            ->latest()
            ->paginate($perPage);
    }
    public function disetujuiByVerifikator($perPage)
    {
        $user = $this->getUser();
        return Ranham::where('verifikator_nip', $user->nip)
            ->where('status', 'Disetujui')
            ->latest()
            ->paginate($perPage);
    }
    public function revisiByVerifikator($perPage)
    {
        $user = $this->getUser();
        return Ranham::where('verifikator_nip', $user->nip)
            ->where('status', 'Revisi')
            ->latest()
            ->paginate($perPage);
    }

    //counter read general item
    public function countReadLahUsulan()
    {
        return Ranham::where('status', 'Usulan')->count();
    }
    public function countLahDisposisi()
    {
        return Ranham::where('status', 'Disposisi')->count();
    }
    public function countLahDitolak()
    {
        return Ranham::where('status', 'Ditolak')->count();
    }
    public function countLahDisetujui()
    {
        return Ranham::where('status', 'Disetujui')->count();
    }
    public function countLahRevisi()
    {
        return Ranham::where('status', 'Revisi')->count();
    }

    //counter read item by verifikator

    public function countReadLahAll()
    {
        $accesRule = ['ADMIN', 'KABAG'];
        $user = $this->getUser();
        $role = $this->getUserRole($accesRule);
        if ($role === true) {
            return Ranham::where('status', 'Usulan')->where('read', 0)->count();
        } else {
            return Ranham::where('verifikator_nip', $user->nip)
                ->where('read', 0)
                ->count();
        }
    }
    public function countReadLahDisposisiByVerfikator()
    {
        $user = $this->getUser();
        return Ranham::where('status', 'Disposisi')
            ->where('verifikator_nip', $user->nip)
            ->where('read', 0)
            ->count();
    }
    public function countLahDitolakByVerfikator()
    {
        $user = $this->getUser();
        return Ranham::where('status', 'Ditolak')
            ->where('verifikator_nip', $user->nip)
            ->count();
    }
    public function countLahDisetujuiByVerfikator()
    {
        $user = $this->getUser();
        return Ranham::where('status', 'Disetujui')
            ->where('verifikator_nip', $user->nip)
            ->count();
    }
    public function countReadLahRevisiByVerfikator()
    {
        $user = $this->getUser();
        return Ranham::where('status', 'Revisi')
            ->where('verifikator_nip', $user->nip)
            ->where('read', 0)
            ->count();
    }
}
