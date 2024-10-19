<?php

namespace App\Http\Controllers;

use App\Services\EcorrectionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class UpdateEcorrectionController extends Controller
{
   protected EcorrectionService $ecorrectionService;

   public function  __construct(EcorrectionService $ecorrectionService) {
      $this->ecorrectionService = $ecorrectionService;
   }

   public function updateEcorrection(Request $request, $id){
      $id = Crypt::decrypt($id);
      $this->ecorrectionService->update($request,$id);
      return redirect()->route("dashboard")->with("success","Data berhasil di perbarui, dan akan di review kembali");

   }
   public function getEcoreectionById($id){
      $id = Crypt::decrypt($id);
      $data = $this->ecorrectionService->getEcorrectionById($id);
      return view('dashboard.page.update-ecorrection')->with('data', $data);
   }
}
