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
   public function sendToVerifikatorTwo($id, $verifikator,$vname, $pesan);
   public function getEcorByUser();
   public function countReadEcorUsulan();
   public function countReadEcorDisposisi();
   public function countReadEcorDitolak();
   public function countReadEcorDisetujui();
   public function countReadEcorRevisi();
   public function countReadEcorAll();
   public function disposisiByVerifikator($perPage);
   public function getrRevisiByVerfikatorTwo($perPage);
   public function getrDitolakByVerfikatorTwo($perPage);
   public function getrDisetujuiByVerfikatorTwo($perPage);
   public function countReadEcorDisposisiByVerfikator();
   public function countReadEcorDitolakByVerfikator();
   public function countReadEcorDisetujuiByVerfikator();
   public function countReadEcorDiperbaikiToVerfikator();

}
