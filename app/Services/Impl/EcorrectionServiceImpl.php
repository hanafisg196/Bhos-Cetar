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

class EcorrectionServiceImpl implements EcorrectionService
{
    private function getUser()
    {
        return Auth::user();
    }
    private function generateCode()
    {
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

    public function createData(Request $request)
    {
        $sessionId = Session::getId();
        $user = $this->getUser();
        $temporaryFiles = Temporary::where('session_id', $sessionId)->get();
        $validate = $request->validate([
            'judul' => 'required|string|max:120',
        ]);
        $ecorrection = Ecorrection::create([
            'title' => $validate['judul'],
            'user_id' => $user->id,
            'nip' => $user->username,
            'nama' => $user->name,
            'code' => $this->generateCode(),
        ]);
        $ecorrection_id = $ecorrection->id;
        $this->copyFilesFromTmp($temporaryFiles, $ecorrection_id);
    }
    public function getEcorrectionById($id)
    {
        return Ecorrection::with('documents')->find($id);
    }

    public function readStatus($id)
    {
        $ecor = Ecorrection::find($id);
        $ecor->update([
            'read' => 1,
        ]);
    }
    public function getListEcorrection()
    {
        return Ecorrection::with('documents')->latest()->paginate(10);
    }

    public function updateEcorrectionStat($id, $stat, $message){
      $update = Ecorrection::where('id', $id)->update([
         'status' => $stat,
         'message' => $message
      ]);

      if($update){
         $ecorrection = Ecorrection::find($id);
         $notif = Notification::where('ecor_id', $id)->first();
         if(!$notif){
            Notification::create([
               "user_id" => $ecorrection->user_id,
               "ecor_id" =>  $id,
               "created_at" => Carbon::now(),
               "notif_read" => 0
            ]);
         } else {
            $notif->update([
               "user_id" => $ecorrection->user_id,
               "ecor_id" =>  $id,
               "created_at" => Carbon::now(),
               "notif_read" => 0
            ]);
         }
      }

    }
}
