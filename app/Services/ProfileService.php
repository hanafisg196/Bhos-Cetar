<?php
namespace App\Services;

use Illuminate\Http\Request;

interface ProfileService {
    public function getCardName(Request $request);
}
