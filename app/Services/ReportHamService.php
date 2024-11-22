<?php

namespace App\Services;

use Illuminate\Http\Request;

interface ReportHamService {

    public function getYear();
    public function getKkp();
    public function saveRanham(Request $request);
    public function getRanhamByUser(Request $request);
    public function getRanhamAll($perPage);
    public function search($search, $perPage);
    public function getRanhamByid($id);
    public function updateStatRanham($id, $stat, $message);
    public function readStatus($id);
    public function updateRanham(Request $request, $id);
    public function searchByUser(Request $request, $search);
    public function inboxCount();
    public function getDataByCatRan($catRan,$year, $perPage);
    public function lisCatRan();
    public function sendToVerifikatorOne($id, $vnip, $vname, $message);
    public function ususlanLah($perPage);
    public function disposisiLah($perPage);
    public function ditolakLah($perPage);
    public function disetujuiLah($perPage);
    public function revisiLah($perPage);
    public function disposisiByVerifikator($perPage);
    public function ditolakByVerifikator($perPage);
    public function disetujuiByVerifikator($perPage);
    public function diperbaikiToVerifikator($perPage);
    public function countReadLahAll();
    public function countReadLahUsulan();
    public function countLahDisposisi();
    public function countLahDitolak();
    public function countLahDisetujui();
    public function countLahRevisi();
    public function countReadLahDisposisiByVerfikator();
    public function countLahDitolakByVerfikator();
    public function countLahDisetujuiByVerfikator();
    public function countReadLahDiperbaikiToVerfikator();



}
