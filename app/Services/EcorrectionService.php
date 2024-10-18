<?php

namespace App\Services;

use Illuminate\Http\Request;

interface EcorrectionService {
   public function createData(Request $request);
   public function getListEcorrection();
   public function getEcorrectionById($id);
   public function readStatus($id);
   public function updateEcorrectionStat($id, $stat, $message);
}
