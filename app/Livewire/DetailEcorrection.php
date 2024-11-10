<?php

namespace App\Livewire;

use App\Models\FixFile;
use App\Models\User;
use App\Services\EcorrectionService;
use App\Services\RoleService;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;
class DetailEcorrection extends Component
{
    use WithFileUploads;
    protected EcorrectionService $ecorrectionService;
    protected RoleService $roleService;

    public function boot(EcorrectionService $ecorrectionService, RoleService $roleService)
    {
        $this->ecorrectionService = $ecorrectionService;
        $this->roleService = $roleService;
    }
    public $id;
    public $verifikatorTwo;
    public $data;
    public $string;
    public $hasDispos;
    public $verifikator;
    public $vname;
    public $pesan = '';
    public $pesanKhusus;
    public $status = '';
    public $file;

    #[On('showDetailEcor')]
    public function render()
    {
        return view('livewire.detail-ecorrection');
    }

    public function mount($id)
    {
        $this->showDetailEcor($this->id = $id);
        $this->getVerifikatorTwo();
        $this->checkDisposAccess();
        $this->updatedVerifikator($this->vname);
    }
    public function sliceStr($string)
    {
        return substr($string, 6);
    }
    public function showDetailEcor($id)
    {
        $id = Crypt::decrypt($id);
        $this->data = $this->ecorrectionService->getEcorrectionById($id);
    }

    public function download($file)
    {
        return response()->download(
            storage_path('app/public/' . $file)
        );
    }
    public function getVerifikatorTwo()
    {
        $this->verifikatorTwo = $this->roleService->getVerifikatorTwo();
    }
    public function checkDisposAccess()
    {
        $this->hasDispos = $this->roleService->disposisiAccess();
    }

    public function updateVerifikatorTwo($id)
    {
        $this->validate([
            'verifikator' => 'required|string',
            'vname' => 'string',
            'pesanKhusus' => 'nullable|string'
        ]);
        $this->ecorrectionService->sendToVerifikatorTwo($id, $this->verifikator, $this->vname, $this->pesanKhusus);
        session()->flash('status', 'Verifikator Berhasil Di tentukan');
        $this->redirect(route('admin.list.ecorrection'));
    }

    public function updateEcor($id)
    {
        $this->validate([
            'status' => 'required',
            'pesan' => 'required',
            'file' => 'nullable|file|mimes:pdf,doc,docx',
        ]);

        $this->ecorrectionService->updateStatEcorrection($id, $this->status, $this->pesan);
        if ($this->file) {
            $fileIsExsist = FixFile::where('ecor_id', $id)->first();
            $fileName = uniqid() . '.' . $this->file->getClientOriginalExtension();
            $filePath = 'verifikator/' . $fileName;

            if ($fileIsExsist) {
                Storage::delete($fileIsExsist->file);
                $fileIsExsist->delete();
            }
            $this->file->storeAs('verifikator', $fileName, 'public');
            FixFile::create([
                'ecor_id' => $id,
                'file' => $filePath,
            ]);
        }
        session()->flash('status', 'Data berhasil di update.');
        $this->redirect(route('admin.list.ecorrection'));
    }

    public function updatedVerifikator($value)
    {
        $verifikator = User::where('nip', $value)->first();
        $this->vname = $verifikator ? $verifikator->name : '';
    }
}
