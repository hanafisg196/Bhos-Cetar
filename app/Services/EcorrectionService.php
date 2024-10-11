<?php

namespace App\Services;

use Illuminate\Http\Request;

interface EcorrectionService {
   public function createData(Request $request);
   public function getListEcorrection();
}
