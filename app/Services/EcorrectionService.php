<?php

namespace App\Services;

use Illuminate\Http\Request;

interface EcorrectionService {
   public function createData(Request $request);
   public function allEcorrections($perPage);
   public function ususlanEcorrections($perPage);
   public function disposisiEcorrections($perPage);
   public function disetujuiEcorrections($perPage);
   public function ditolakEcorrections($perPage);
   public function revisiEcorrections($perPage);
   public function getEcorrectionById($id);
   public function readStat($id);
   public function updateStatEcorrection($id, $stat, $message);
   public function update(Request $request, $id);
   public function search($search, $perPage);
   public function sendToVerifikatorTwo($id, $verifikator);
   public function getEcorByUser();


}
