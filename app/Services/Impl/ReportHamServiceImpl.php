<?php
namespace App\Services\Impl;

use App\Models\Kkp;
use App\Models\Notification;
use App\Models\Ranham;
use App\Services\ReportHamService;
use Illuminate\Http\Request;

class ReportHamServiceImpl implements ReportHamService {
    public function generateCode(){
        $prefix = 'LAH';
        $randomNumber = mt_rand(10000, 99999);
        return $prefix . $randomNumber;
    }
    public function getKkp() {
      return  Kkp::latest()->get();
    }

    public function getRanhamByUser($id) {
        return Ranham::where("user_id", $id)->latest()->paginate(3);
    }
    public function getRanhamAll($perPage) {
        return Ranham::latest()->paginate($perPage);
    }
    public function getUserId(Request $request)
    {
      return $request->session()->get('user');
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
            "user_id"=> $user['pegawai']['nip'],
            "name"=>$user['pegawai']['nama'],
            "code"=> $this->generateCode()
        ]);

    }
    public function updateStatRanham($id, $stat, $message)
    {
       $update = Ranham::where('id', $id)->update([
            'status' => $stat,
            'message' => $message,
        ]);

        if($update) {
            $schedule = Ranham::find($id);
            Notification::updateOrCreate([
                "user_id" => $schedule->user_id,
                "lah_id" =>  $id,
                "notif_read" => 0
            ]);
        }
    }
    public function getRanhamByid($id){
        return Ranham::find($id);
    }
    public function search($search, $perPage)
    {
       return Ranham::where('nama', 'like', '%' . $search . '%')
       ->paginate($perPage);

    }

    public function readStatus($id)
    {
        $data = Ranham::where('id', $id);
        $data->update([
            'read' => 1,
        ]);
    }
}
