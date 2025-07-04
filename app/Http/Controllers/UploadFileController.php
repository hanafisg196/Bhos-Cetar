<?php

namespace App\Http\Controllers;

use App\Models\Temporary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UploadFileController extends Controller
{
   public function upload(Request $request)
   {
        $request->validate([
         'file' => 'mimes:png,jpg,doc,pdf|mimetypes:image/png,image/jpeg,application/msword,application/pdf'
        ]);
          $sessionId = Session::getId();
        if($request->hasFile('file')){
            $file = $request->file('file');
            $fileName = uniqid() . '.' . $file->getClientOriginalExtension();
            $file = $file->storeAs('files/tmp/'. $fileName);

            Temporary::create([
                'file' => $file,
                'session_id' => $sessionId,
            ]);
            return $file;
        }

        return '';


   }
}
