<?php

namespace App\Http\Controllers;

use App\Services\EcorrectionService;
use Illuminate\Http\Request;

class EcorrectionController extends Controller
{
   protected EcorrectionService $ecorrectionService;

   public function  __construct(EcorrectionService $ecorrectionService) {
      $this->ecorrectionService = $ecorrectionService;
   }

    public function index(){
      $ecor = $this->ecorrectionService->getEcorByUser();
      return view('dashboard.page.ecorrection')->with('ecor', $ecor);
    }

    public function inbox(){
      return view('admin.page.list-inbox-ecor');
    }

    public function createEcor(Request $request){
         $this->ecorrectionService->createData($request);
         return redirect()->back()->with('success', 'Laporan Ecorrection Berhasil Dikirim');
    }
}
