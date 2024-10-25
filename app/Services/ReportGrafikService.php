<?php
namespace App\Services;

interface ReportGrafikService {
   public function getLbhReport();
   public function getReportKinerja();
   public function getReportKinerjaByVerifikator();
}
