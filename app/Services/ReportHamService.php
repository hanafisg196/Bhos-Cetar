<?php

namespace App\Services;

use Illuminate\Http\Request;

interface ReportHamService {

    public function getKkp();
    public function saveRanham(Request $request);
    public function getRanhamByUser($id);
    public function getRanhamAll($perPage);
    public function search($search, $perPage);
    public function getRanhamByid($id);
    public function updateStatRanham($id, $stat, $message);
    public function readStatus($id);

}
