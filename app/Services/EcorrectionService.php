<?php

namespace App\Services;

use Illuminate\Http\Request;

interface EcorrectionService {
   public function createData(Request $request);
   public function getListEcorrection($perPage);
   public function getEcorrectionById($id);
   public function readStat($id);
   public function updateStatEcorrection($id, $stat, $message);
   public function update(Request $request, $id);
   public function search($search, $perPage);
   public function sendToVerifikatorTwo($id, $verfikatorId);
   public function getEcorByUser();
}
