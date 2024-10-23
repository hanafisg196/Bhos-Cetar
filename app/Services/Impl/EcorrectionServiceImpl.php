<?php

namespace App\Services\Impl;

use App\Models\Document;
use App\Models\Ecorrection;
use App\Models\Notification;
use App\Models\Temporary;
use App\Services\EcorrectionService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class EcorrectionServiceImpl implements EcorrectionService {

   private function getUser(){
       return Auth::user();
   }
   private function getUserRole($rule)
   {
       return Auth::user()->rules->pluck('nama')->intersect($rule)->isNotEmpty();
   }
   public function getEcorrectionById($id){
      return Ecorrection::with('dokumens')->find($id);
   }
   private function generateCode(){
      $prefix = 'ECOR';
      $randomNumber = mt_rand(10000, 99999);
      return $prefix . $randomNumber;
  }
  private function copyFilesFromTmp($tmpFile, $idFile)
  {
      foreach ($tmpFile as $tmp) {
          $sourcePath = $tmp->file;
          $destinationPath = 'files/' . basename($sourcePath);
          Storage::copy($sourcePath, $destinationPath);
          $existingDocuments = Document::where('ecorrection_id', $idFile)->get();
          if($existingDocuments->isNotEmpty()){
            foreach ($existingDocuments as $document) {
               Storage::delete($document->file);
               $document->delete();
           }
          }
          Document::create([
              'ecorrection_id' => $idFile,
              'file' => $destinationPath,
          ]);

          Storage::delete($sourcePath);
          $tmp->delete();
      }
  }

   public function createData(Request $request){
      $sessionId = Session::getId();
      $user = $this->getUser();
      $temporaryFiles = Temporary::where('session_id', $sessionId)->get();
      $validate = $request->validate([
         'judul' => 'required|string|max:120',
      ]);
      $ecorrection  = Ecorrection::create([
         'title' => $validate['judul'],
         'user_id' => $user->id,
         'nip' => $user->username,
         'nama' => $user->name,
         'code' => $this->generateCode(),
      ]);
      $ecorrection_id = $ecorrection->id;
      $this->copyFilesFromTmp($temporaryFiles, $ecorrection_id);

   }

   public function allEcorrections($perPage){
          return Ecorrection::with('dokumens')
         ->orderByRaw("CASE WHEN status = 'Usulan' THEN 1 ELSE 2 END")
         ->latest()
         ->paginate($perPage);
   }
   public function ususlanEcorrections($perPage){
    return  Ecorrection::where('status', 'Usulan')->latest()->paginate($perPage);
   }
   public function disposisiEcorrections($perPage){
      return  Ecorrection::where('status', 'Disposisi')->latest()->paginate($perPage);
   }
   public function disetujuiEcorrections($perPage){
      return Ecorrection::where('status', 'Disetujui')->latest()->paginate($perPage);
   }
   public function ditolakEcorrections($perPage){
      return  Ecorrection::where('status', 'Ditolak')->latest()->paginate($perPage);
   }
   public function revisiEcorrections($perPage){
      return Ecorrection::where('status', 'Revisi')->latest()->paginate($perPage);
   }



   public function getrRevisiByVerfikatorTwo($perPage){
      $user = $this->getUser();
      return Ecorrection::where('status', 'Revisi')->where('verifikator_nip', $user->nip)
         ->latest()->paginate($perPage);
    }

    public function getrDitolakByVerfikatorTwo($perPage){
      $user = $this->getUser();
      return Ecorrection::where('verifikator_nip', $user->nip)->where('status', 'Ditolak')
         ->latest()->paginate($perPage);
    }

    public function getrDisetujuiByVerfikatorTwo($perPage){
      $user = $this->getUser();
      return Ecorrection::where('verifikator_nip', $user->nip)->where('status', 'Disetujui')
         ->latest()->paginate($perPage);
    }

   public function readStat($id){
      $accessRule = ['ADMIN', 'KABAG'];
      $stat = ['Revisi', 'Ditolak', 'Disetujui', 'Disposisi'];
      $rule = $this->getUserRole($accessRule);
      $data = $this->getEcorrectionById($id);
      $allowedStat = in_array($data->status, $stat);
      if ($rule === true && $allowedStat === true) {
            'baca mantra , skidipapap yehe yehe';
      } else {
          $data->update([
              'read' => 1
          ]);
      }
  }


   public function updateStatEcorrection($id, $stat, $message)
    {
        $update = Ecorrection::where('id', $id)->update([
            'status' => $stat,
            'message' => $message,
        ]);

        if($update) {
            $ecor = Ecorrection::find($id);
            $notif = Notification::where('ecor_id', $id)->first();
            if(!$notif){
               Notification::create([
                    "user_id" => $ecor->user_id,
                    "ecor_id" =>  $id,
                    "created_at" => Carbon::now(),
                    "notif_read" => 0
                ]);
            } else{
                $notif->update([
                    "user_id" => $ecor->user_id,
                    "ecor_id" =>  $id,
                    "created_at" => Carbon::now(),
                    "notif_read" => 0
                ]);
            }

        }
    }

    public function update(Request $request, $id){
      $ecor = $this->getEcorrectionById($id);
      $sessionId = Session::getId();
      $validated = $request->validate([
         'judul' => 'required|string|max:120',
      ]);
      $temporaryFiles = Temporary::where('session_id', $sessionId)->get();
      $ecor->update([
         'title' => $validated['judul'],
         'status'=>  "Revisi",
         'read' => 0
      ]);
      $ecorrection_id = $ecor->id;
      $this->copyFilesFromTmp($temporaryFiles, $ecorrection_id);
    }
    public function search($search, $perPage)
    {
      return Ecorrection::where('title', 'like', '%' . $search . '%')
      ->latest()->paginate($perPage);
    }

    public function disposisiByVerifikator($perPage){
         $user = $this->getUser();
             return Ecorrection::where('status', 'Disposisi')
                ->where('verifikator_nip', $user->nip)
                ->latest()
                ->paginate($perPage);
    }
    public function sendToVerifikatorTwo($id, $verifikator){
      $ecor = $this->getEcorrectionById($id);
      $ecor->update([
         'verifikator_nip' => $verifikator,
         'status' => 'Disposisi',
         'read' => 0
      ]);
    }

    public function getEcorByUser()
    {
        $user = $this->getUser();
        return Ecorrection::where('user_id', $user->id)
            ->latest('updated_at')
            ->paginate(10, ['*'], 'ecorrections-page');
    }


   //counter read general item
    public function countReadEcorUsulan(){
     return  Ecorrection::where('status', 'Usulan')->count();
    }
    public function countReadEcorDisposisi(){
      return Ecorrection::where('status', 'Disposisi')->count();
    }
    public function countReadEcorDitolak(){
      return Ecorrection::where('status', 'Ditolak')->count();
    }
    public function countReadEcorDisetujui(){
      return Ecorrection::where('status', 'Disetujui')->count();
    }
    public function countReadEcorRevisi(){
      return Ecorrection::where('status', 'Revisi')->count();
    }

 //counter read item by verifikator

 public function countReadEcorAll(){
   $accesRule = ['ADMIN', 'KABAG'];
   $user = $this->getUser();
   $role = $this->getUserRole($accesRule);
   if($role === true){
      return Ecorrection::where('status', 'Usulan')
      ->where('read', 0)->count();

   }else{
      return Ecorrection::where('verifikator_nip', $user->nip)
      ->where('read', 0)->count();
   }
 }
 public function countReadEcorDisposisiByVerfikator(){
   $user = $this->getUser();
   return Ecorrection::where('status', 'Disposisi')
   ->where('verifikator_nip', $user->nip)
   ->where('read', 0)
   ->count();
 }
 public function countReadEcorDitolakByVerfikator(){
   $user = $this->getUser();
   return Ecorrection::where('status', 'Ditolak')
   ->where('verifikator_nip', $user->nip)
   ->where('read', 1)
   ->count();
 }
 public function countReadEcorDisetujuiByVerfikator(){
   $user = $this->getUser();
   return Ecorrection::where('status', 'Disetujui')
   ->where('verifikator_nip', $user->nip)
   ->where('read', 1)
   ->count();
 }
 public function countReadEcorRevisiByVerfikator(){
   $user = $this->getUser();
   return Ecorrection::where('status', 'Revisi')
   ->where('verifikator_nip', $user->nip)
   ->where('read', 0)
   ->count();
 }


}
