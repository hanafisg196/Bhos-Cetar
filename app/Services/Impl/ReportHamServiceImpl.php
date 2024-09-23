<?php
namespace App\Services\Impl;

use App\Models\CategoryRanhamn;
use App\Models\Kkp;
use App\Models\Notification;
use App\Models\Ranham;
use App\Services\ReportHamService;
use Carbon\Carbon;
use Illuminate\Http\Request;

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
    public function getUserId(Request $request)
    {
        $user = $request->session()->get('user');
        // $user_id = $user['pegawai']['nip'];
        return $user;
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
        $user = $this->getUserId($request);
        return Ranham::where('user_id', $user['pegawai']['nip'])
            ->latest('updated_at')
            ->paginate(5, ['*'], 'aksi-ham-page');
    }

    public function getRanhamAll($perPage)
    {
        return Ranham::latest('updated_at')->paginate($perPage);
    }

    public function saveRanham(Request $request)
    {
        $user = $this->getUserId($request);
        $validated = $request->validate([
            'link' => 'required|url',
            'kkp' => 'required',
        ]);
        Ranham::create([
            'link' => $validated['link'],
            'kkp_id' => $validated['kkp'],
            'user_id' => $user['pegawai']['nip'],
            'name' => $user['pegawai']['nama'],
            'code' => $this->generateCode(),
            'catran_id' => $this->getCatRanId(),
        ]);
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
                $notif = Notification::create([
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
        ]);
    }

    public function search($search, $perPage)
    {
        return Ranham::where('name', 'like', '%' . $search . '%')->paginate($perPage);
    }

    public function searchByUser(Request $request, $search)
    {
        $user = $this->getUserId($request);
        return Ranham::where('name', 'like', '%' . $search . '%')
            ->where('user_id', $user)
            ->latest()
            ->paginate(5);
    }

    public function readStatus($id)
    {
        $data = Ranham::where('id', $id);
        $data->update([
            'read' => 1,
        ]);
    }

    public function inboxCount()
    {
        return Ranham::where('read', 0)->count();
    }

    public function lisCatRan(){
       return CategoryRanhamn::get();
    }

    public function getDataByCatRan($catRan,$perPage){
        return Ranham::where('catran_id', $catRan)->latest('updated_at')->paginate($perPage);
    }
}
