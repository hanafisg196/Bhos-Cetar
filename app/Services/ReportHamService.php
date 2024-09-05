<?php

namespace App\Services;

use Illuminate\Http\Request;

interface ReportHamService {

    public function getKkp();
    public function saveRanham(Request $request);
    public function getRanhamByUser($id);

}
