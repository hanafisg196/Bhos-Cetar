<?php

namespace App\Http\Controllers;

use App\Services\EcorrectionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class EcorrectionController extends Controller
{
   protected EcorrectionService $ecorrectionService;

   public function  __construct(EcorrectionService $ecorrectionService) {
      $this->ecorrectionService = $ecorrectionService;
   }

    public function index(){

      return view('dashboard.page.ecorrection');
    }

    public function inbox(){
      return view('admin.page.list-inbox-ecor');
    }

    public function createEcor(Request $request){
         $this->ecorrectionService->createData($request);
         return redirect()->back()->with('success', 'Laporan Ecorrection Berhasil Dikirim');
    }
    public function getEcorrection($id){
     $id = Crypt::decrypt($id);
     $data = $this->ecorrectionService->getEcorrectionById($id);

      return view('dashboard.page.update-ecorrection')->with([
         'data' => $data
      ]);
    }
}
