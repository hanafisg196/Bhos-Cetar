<?php
namespace App\Services\Impl;

use App\Models\Kkp;
use App\Models\Ranham;
use App\Services\ReportHamService;
use Illuminate\Http\Request;

class ReportHamServiceImpl implements ReportHamService {
    public function getKkp() {
      return  Kkp::latest()->get();
    }

    public function getRanhamByUser($id) {
        return Ranham::where("user_id", $id)->latest()->paginate(3);
    }
    public function getUserId(Request $request)
    {
        $user = $request->session()->get('user');
        $user_id = $user['pegawai']['nip'];
        return $user_id;
    }
    public function  saveRanham( Request $request ) {
        $user = $this->getUserId($request);
        $validated = $request->validate([
            "link"=> "required|active_url",
            "kkp_id"=> "required"

        ]);
        Ranham::create([
            "link"=> $validated["link"],
            "kkp_id"=> $validated["kkp_id"],
            "user_id"=> $user
        ]);

    }

}
