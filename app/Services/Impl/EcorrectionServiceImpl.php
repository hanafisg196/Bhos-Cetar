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
   public function getListEcorrection($perPage){

      $user = $this->getUser();
      $kabag = $this->getUserRole('KABAG');
      if ($kabag ){
         return Ecorrection::with('dokumens')->where('status', 'Usulan')->latest()->paginate(perPage: $perPage);
      } else{
         return Ecorrection::with('dokumens')
         ->where('status', '!=' , 'Usulan')
         ->where('dispos_id', $user->id)
         ->latest()->paginate(perPage: $perPage);
      }

   }

   public function getEcorrectionById($id){
      return Ecorrection::with('dokumens')->find($id);
   }

   public function readStat($id){
     $data =  $this->getEcorrectionById($id);
     $data->update([
      'read' => 1
     ]);
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

    private function deleteDocument($id){
      $document = Document::where('id', $id)->first();
      Storage::delete($document->file);
      $document->delete();
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
      $this->deleteDocument($ecorrection_id);
      $this->copyFilesFromTmp($temporaryFiles, $ecorrection_id);
    }
    public function search($search, $perPage)
    {
      $user = $this->getUser();
      $kabag = $this->getUserRole('KABAG');
       if ($kabag ){
         return Ecorrection::where('title', 'like', '%' . $search . '%')
         ->paginate($perPage)
         ->where('status', 'Usulan')->latest()->paginate(perPage: $perPage);
       } else{
         return Ecorrection::where('title', 'like', '%' . $search . '%')
          ->where('status', '!=' , 'Usulan')
          ->where('dispos_id', $user->id)
          ->latest()->paginate(perPage: $perPage);
       }

    }

    public function sendToVerifikatorTwo($id, $verfikatorId){
      $ecor = $this->getEcorrectionById($id);
      $ecor->update([
         'dispos_id' => $verfikatorId,
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
}
