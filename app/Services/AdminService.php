<?php
namespace App\Services;

interface AdminService {

    public function countReportYear();
    public function countReportMonth();
    public function countReportWeek();
    public function countUpdatedData();
    public function countInboxLah();
    public function countInboxLbh();


}
