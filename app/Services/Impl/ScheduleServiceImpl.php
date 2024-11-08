<?php
namespace App\Services\Impl;

use App\Models\Document;
use App\Models\Notification;
use App\Models\Schedule;
use App\Models\Temporary;
use App\Models\TrackingPoint;
use App\Services\ScheduleService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class ScheduleServiceImpl implements ScheduleService
{

    public function getUser()
    {
       return  Auth::user();
    }
    private function getUserRole($rule)
    {
       return Auth::user()->rules->pluck('nama')->intersect($rule)->isNotEmpty();
    }

    private function createTrackingPointLbh($id,$status,$naphon,$napem,$kabag){
      TrackingPoint::create([
         'lbh_id' => $id,
         'status' => $status,
         'nama_pemohon' => $naphon,
         'nama_pemeriksa' => $napem,
         'nama_kabag' => $kabag
      ]);
    }

    private function copyFilesFromTmp($tmpFile, $idFile)
    {
        foreach ($tmpFile as $tmp) {
            $sourcePath = $tmp->file;
            $destinationPath = 'files/' . basename($sourcePath);
            Storage::copy($sourcePath, $destinationPath);
            Document::create([
                'schedule_id' => $idFile,
                'file' => $destinationPath,
            ]);
            Storage::delete($sourcePath);
            $tmp->delete();
        }
    }
    public function createSchedule(Request $request)
    {
        $sessionId = Session::getId();
        $user = $this->getUser();
        $temporaryFiles = Temporary::where('session_id', $sessionId)->get();
        $validated = $request->validate([
            'nama' => 'required|string|max:120',
            'alamat' => 'required|string|max:150',
            'email' => 'required|email|max:120',
            'kronologi' => 'required|string',
            'wa' => 'required|numeric|min:13',
           ]);
            $schedule = Schedule::create([
                'nip' => $user->username,
                'nama' => $validated['nama'],
                'alamat' => $validated['alamat'],
                'email' => $validated['email'],
                'kronologi' => $validated['kronologi'],
                'wa' => $validated['wa'],
                'user_id' => $user->id,
                'code' => $this->generateCode()
            ]);

            $schedule_id = $schedule->id;
            $this->copyFilesFromTmp($temporaryFiles, $schedule_id);
            $schedule->refresh();
            $this->createTrackingPointLbh(
               $schedule_id,
               $schedule->status,
               $user->name,
               null,
               null
            );
    }

    public function updateSchedule(Request $request, $id){
        $user = $this->getUser();
        $sessionId = Session::getId();
        $temporaryFiles = Temporary::where('session_id', $sessionId)->get();
        $validated = $request->validate([
            'nama' => 'required|string|max:120',
            'alamat' => 'required|string|max:150',
            'email' => 'required|email|max:120',
            'kronologi' => 'required|string',
            'wa' => 'required|numeric|min:13',
        ]);
        $schedule = Schedule::find($id);
        $schedule->update([
            'nama' => $validated['nama'],
            'alamat' => $validated['alamat'],
            'email' => $validated['email'],
            'kronologi' => $validated['kronologi'],
            'wa' => $validated['wa'],
            'status'=>  "Diperbaiki",
            'read' => 0
        ]);
        $schedule_id = $schedule->id;
        $this->copyFilesFromTmp($temporaryFiles, $schedule_id);
        $notif = Notification::where('lbh_id', $schedule_id);
        $notif->update([
           'notif_read' => 1
        ]);
        $schedule->refresh();
        $this->createTrackingPointLbh(
         $schedule_id,
         $schedule->status,
         $user->name,
         null,
         null
        );
    }

    public function generateCode(){
        $prefix = 'LBH';
        $randomNumber = mt_rand(10000, 99999);
        return $prefix . $randomNumber;
    }

    public function getAllSchedules($perPage)
    {
        return Schedule::latest('updated_at')->paginate($perPage);
    }

    public function getSchedulesByUser(Request $request)
    {
        $user = $this->getUser();
        return Schedule::latest('updated_at')->where('user_id', $user->id)->with('documents')
        ->paginate(5, ['*'], 'bantuan-hukum-page');
    }

    public function readStatus($id)
    {
      $accessRule = ['ADMIN', 'KABAG'];
      $stat = ['Revisi', 'Ditolak', 'Disetujui', 'Disposisi'];
      $rule = $this->getUserRole($accessRule);
      $data = Schedule::find($id);
      $allowedStat = in_array($data->status, $stat);
      if ($rule === true && $allowedStat === true) {
            'baca mantra , skidipapap yehe yehe';
      } else {
          $data->update([
              'read' => 1
          ]);
      }
    }

    public function getDetailSchedule($id)
    {
        return Schedule::with('documents')->find($id);
    }

    public function getScheduleById($id)
    {
        return Schedule::find($id);
    }

    public function search($search, $perPage)
    {
       return Schedule::where('nama', 'like', '%' . $search . '%')
       ->orWhere('nip', 'like', '%' . $search . '%')
       ->orWhere('code', 'like', '%' . $search . '%')
       ->paginate($perPage);

    }
    public function deleteSchedule($id)
    {
        $schedule = Schedule::find($id);
        $documents = Document::where('schedule_id', $id)->get();

        foreach ($documents as $doc) {
            Storage::delete($doc->file);
            $doc->delete();
        }
        $schedule->delete();
    }

    public function deleteDocument($id){
        $documents = Document::find($id);
        Storage::delete($documents->file);
        $documents->delete();
    }


    public function inboxCount()
    {
        return Schedule::where('read', 0)->count();
    }

    public function countUsulan()
    {
        return Schedule::where('status', 'Usulan')->count();
    }

    public function updateStatSchdeule($id, $stat, $message)
    {
        $update = Schedule::where('id', $id)->update([
            'status' => $stat,
            'message' => $message,

        ]);

        if($update) {
            $schedule = Schedule::find($id);
            $notif = Notification::where('lbh_id', $id)->first();

            if(!$notif){
               Notification::create([
                    "user_id" => $schedule->user_id,
                    "lbh_id" =>  $id,
                    "created_at" => Carbon::now(),
                    "notif_read" => 0
                ]);
            } else{
                $notif->update([
                    "user_id" => $schedule->user_id,
                    "lbh_id" =>  $id,
                    "created_at" => Carbon::now(),
                    "notif_read" => 0
                ]);
            }
            $schedule->refresh();
            $this->createTrackingPointLbh(
               $schedule->id,
               $schedule->status,
               null,
               $schedule->verifikator_name,
               null
              );
        }
    }
    public function download($file)
    {
        return Storage::download('files/'. $file);
    }
    public function sendToVerifikatorOne($id,$vnip, $vname, $message){
      $lbh = $this->getScheduleById($id);
      $user = $this->getUser();
      $kabag =  $user->rules->where('nama', 'KABAG')->isNotEmpty() ?  $user->name : null;
      $lbh->update([
         'verifikator_nip' => $vnip,
         'verifikator_name' => $vname,
         'status' => 'Disposisi',
         'message' => $message,
         'read' => 0
      ]);
      $lbh->refresh();
        $this->createTrackingPointLbh(
         $lbh->id,
         $lbh->status,
         null,
         $lbh->verifikator_name,
         $kabag
        );

     }
     public function ususlanLbh($perPage){
      return  Schedule::where('status', 'Usulan')->latest()->paginate($perPage);
     }
     public function disposisiLbh($perPage){
      return  Schedule::where('status', 'Disposisi')->latest()->paginate($perPage);
     }
     public function ditolakLbh($perPage){
      return  Schedule::where('status', 'Ditolak')->latest()->paginate($perPage);
     }
     public function disetujuiLbh($perPage){
      return  Schedule::where('status', 'Disetujui')->latest()->paginate($perPage);
     }

     public function revisiLbh($perPage){
      return  Schedule::where('status', 'Revisi')->latest()->paginate($perPage);
     }
     public function disposisiByVerifikator($perPage){
      $user = $this->getUser();
      return Schedule::where('verifikator_nip', $user->nip)->where('status', 'Disposisi' )
      ->latest()->paginate($perPage);
     }
     public function ditolakByVerifikator($perPage){
      $user = $this->getUser();
      return Schedule::where('verifikator_nip', $user->nip)->where('status', 'Ditolak' )
      ->latest()->paginate($perPage);
     }
     public function disetujuiByVerifikator($perPage){
      $user = $this->getUser();
      return Schedule::where('verifikator_nip', $user->nip)->where('status', 'Disetujui' )
      ->latest()->paginate($perPage);
     }
     public function diperbaikiToVerifikator($perPage){
      $user = $this->getUser();
      return Schedule::where('verifikator_nip', $user->nip)->where('status', 'Diperbaiki' )
      ->latest()->paginate($perPage);
     }
  //counter read general item
  public function countReadLbhUsulan(){
   return  Schedule::where('status', 'Usulan')->where('read', 0)->count();
  }
  public function countLbhDisposisi(){
    return Schedule::where('status', 'Disposisi')->count();
  }
  public function countLbhDitolak(){
    return Schedule::where('status', 'Ditolak')->count();
  }
  public function countLbhDisetujui(){
    return Schedule::where('status', 'Disetujui')->count();
  }
  public function countLbhRevisi(){
    return Schedule::where('status', 'Revisi')->count();
  }

//counter read item by verifikator

public function countReadLbhAll(){
 $accesRule = ['ADMIN', 'KABAG'];
 $user = $this->getUser();
 $role = $this->getUserRole($accesRule);
 if($role === true){
    return Schedule::where('status', 'Usulan')
    ->where('read', 0)->count();

 }else{
    return Schedule::where('verifikator_nip', $user->nip)
    ->where('read', 0)->count();
 }
}
public function countReadLbhDisposisiByVerfikator(){
 $user = $this->getUser();
 return Schedule::where('status', 'Disposisi')
 ->where('verifikator_nip', $user->nip)
 ->where('read', 0)
 ->count();
}
public function countLbhDitolakByVerfikator(){
 $user = $this->getUser();
 return Schedule::where('status', 'Ditolak')
 ->where('verifikator_nip', $user->nip)
 ->count();
}
public function countLbhDisetujuiByVerfikator(){
 $user = $this->getUser();
 return Schedule::where('status', 'Disetujui')
 ->where('verifikator_nip', $user->nip)
 ->count();
}
public function countReadLbhDiperbaikiToVerfikator(){
 $user = $this->getUser();
 return Schedule::where('status', 'Diperbaiki')
 ->where('verifikator_nip', $user->nip)
 ->where('read', 0)
 ->count();
}
public function tracking($postId){
  return TrackingPoint::where('lbh_id', $postId)->get();
}


}
