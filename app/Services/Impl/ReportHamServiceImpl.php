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
    private function createTrackingPointLah($id,$status,$naphon,$napem, $kabag){
      TrackingPoint::create([
         'lah_id' => $id,
         'status' => $status,
         'nama_pemohon' => $naphon,
         'nama_pemeriksa' => $napem,
         'nama_kabag' => $kabag
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
            'link' => 'required|url|string|max:200',
            'kkp' => 'required',
        ]);
        $ranham = Ranham::create([
            'link' => $validated['link'],
            'kkp_id' => $validated['kkp'],
            'user_id' => $user->id,
            'nip' => $user->nip,
            'name' => $user->name,
            'code' => $this->generateCode(),
            'catran_id' => $this->getCatRanId(),
        ]);
        $ranham->refresh();
        $this->createTrackingPointLah(
         $ranham->id,
         $ranham->status,
          $user->name,
          null,
          null
         );
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
                null,
                $ranham->verifikator_name,
                null
               );
        }
    }
    public function updateRanham(Request $request, $id)
    {
        $user = $this->getUser();
        $ranham = Ranham::find($id);
        $validated = $request->validate([
            'link' => 'required|url|string|max:200',
            'kkp_id' => 'required',
        ]);
        $ranham->update([
            'link' => $validated['link'],
            'kkp_id' => $validated['kkp_id'],
            'status' => 'Diperbaiki',
            'read' => 0
        ]);
        $notif = Notification::where('lah_id', $ranham->id);
        $notif->update([
           'notif_read' => 1
        ]);
        $ranham->refresh();
        $this->createTrackingPointLah(
         $ranham->id,
         $ranham->status,
          $user->name,
          null,
          null
         );
    }

    public function search($search, $perPage)
    {
        return Ranham::where('name', 'like', '%' . $search . '%')
        ->orWhere('code', 'like', '%' . $search . '%')
        ->orWhere('nip', 'like', '%' . $search . '%')
        ->paginate($perPage);
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

    public function sendToVerifikatorOne($id, $vnip, $vname, $message)
    {
        $lah = $this->getRanhamByid($id);
        $user = $this->getUser();
        $kabag =  $user->rules->where('nama', 'KABAG')->isNotEmpty() ?  $user->name : null;
        $lah->update([
            'verifikator_nip' => $vnip,
            'verifikator_name' => $vname,
            'status' => 'Disposisi',
            'message' => $message,
            'read' => 0,
        ]);

        $lah->refresh();
        $this->createTrackingPointLah(
         $lah->id,
         $lah->status,
         null,
         $lah->verifikator_name,
         $kabag
         );
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
    public function diperbaikiToVerifikator($perPage){
      $user = $this->getUser();
      return Ranham::where('verifikator_nip', $user->nip)->where('status', 'Diperbaiki' )
      ->latest()->paginate($perPage);
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
    public function countReadLahDiperbaikiToVerfikator()
    {
        $user = $this->getUser();
        return Ranham::where('status', 'Diperbaiki')
            ->where('verifikator_nip', $user->nip)
            ->where('read', 0)
            ->count();
    }
}
