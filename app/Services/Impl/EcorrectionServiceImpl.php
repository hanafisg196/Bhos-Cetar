<?php

namespace App\Services\Impl;

use App\Models\Document;
use App\Models\Ecorrection;
use App\Models\Temporary;
use App\Services\EcorrectionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class EcorrectionServiceImpl implements EcorrectionService {

   private function getUser(Request $request){
       return $request->session()->get('user');
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
      $user = $this->getUser($request);
      $temporaryFiles = Temporary::where('session_id', $sessionId)->get();
      $validate = $request->validate([
         'judul' => 'required|string|max:120',
      ]);
      $ecorrection  = Ecorrection::create([
         'title' => $validate['judul'],
         'user_id' => $user['pegawai']['nip'],
         'nip' => $user['pegawai']['nip'],
         'nama' => $user['pegawai']['nama'],
         'code' => $this->generateCode(),
      ]);
      $ecorrection_id = $ecorrection->id;
      $this->copyFilesFromTmp($temporaryFiles, $ecorrection_id);

   }
   public function getListEcorrection(){
      return Ecorrection::with('dokumens')->latest()->paginate(10);
   }
}
