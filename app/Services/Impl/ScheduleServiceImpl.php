<?php
namespace App\Services\Impl;

use App\Models\Document;
use App\Models\Schedule;
use App\Models\Temporary;
use App\Services\ScheduleService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class ScheduleServiceImpl implements ScheduleService {



    public function copyFilesFromTmp($tmpFile,$idFile)
    {
        foreach($tmpFile as $tmp)
        {
            $sourcePath = $tmp->file;
            $destinationPath = 'files/'. basename($sourcePath);
            Storage::copy($sourcePath, $destinationPath);
            Document::create([
                'schedule_id' => $idFile,
                'file' => $destinationPath
            ]);
            Storage::delete($sourcePath);
            $tmp->delete();
        }
    }
    public function createSchedule(Request $request) {

            $sessionId = Session::getId();
            $user_id = $this->getUserId($request);
            $temporaryFiles = Temporary::where('session_id', $sessionId)->get();

            $validated = $request->validate([
                'nip' =>'required|numeric|min:18',
                'nama' =>'required|string|max:120',
                'alamat' =>'required|string|max:150',
                'email' =>'required|email|max:120',
                'kronologi' =>'required|string',
                'wa' =>'required|numeric|min:13',

            ]);

            $schedule = Schedule::create([
                'nip' => $validated['nip'],
                'nama' => $validated['nama'],
                'alamat' => $validated['alamat'],
                'email' => $validated['email'],
                'kronologi' => $validated['kronologi'],
                'wa' => $validated['wa'],
                'user_id' => $user_id,
            ]);


            $schedule_id = $schedule->id;
            $this->copyFilesFromTmp($temporaryFiles,$schedule_id);

    }

    public function getAllSchedules($perPage) {
        return Schedule::latest()->paginate($perPage);
    }

    public function getUserId(Request $request){
        $user = $request->session()->get('user');
        $user_id = $user['pegawai']['nip'];
        return $user_id;
    }

    public function getSchedulesByid($id) {
        return Schedule::latest()->where('user_id',$id)->get();
    }

    public function readSchedule($id){
        $data =  Schedule::where('id', $id);
        $data->update([
            'read' => 1
        ]);
    }

    public function getDetailSchedule($id)
    {
       return  Schedule::with('dokumens')->find($id);
    }

    public function search($search, $perPage) {
        $data = Schedule::where('nama', 'like', '%'. $search. '%')
        ->paginate($perPage);
        return $data;
    }
    public function deleteSchedule($id){
        $schedule = Schedule::find($id);
        $documents  = Document::where('schedule_id',$id)->get();

        foreach($documents as $doc){
            Storage::delete($doc->file);
            $doc->delete();
        }
        $schedule->delete();

    }

    public function inboxCount(){
        return Schedule::where('read', 0)->count();

    }

    public function countUsualan(){
        return Schedule::where('status', 'Usulan')->count();

    }

    public function updateStatSchdeule($id, $stat){
       return Schedule::where('id', $id)->update([
            'status' =>  $stat
        ]);
    }

}
