<?php
namespace App\Services\Impl;

use App\Services\EmployeeService;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;

class EmployeeServiceImpl implements EmployeeService {
   private function fetchApiEmployee($code){
      $apiKey ='eyJ4NXQiOiJOVGRtWmpNNFpEazNOalkwWXpjNU1tWm1PRGd3TVRFM01XWXdOREU1TVdSbFpEZzROemM0WkE9PSIsImtpZCI6ImdhdGV3YXlfY2VydGlmaWNhdGVfYWxpYXMiLCJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJzdWIiOiJkaXNrb21pbmZvX3RhbmFoZGF0YXJAY2FyYm9uLnN1cGVyIiwiYXBwbGljYXRpb24iOnsib3duZXIiOiJkaXNrb21pbmZvX3RhbmFoZGF0YXIiLCJ0aWVyUXVvdGFUeXBlIjpudWxsLCJ0aWVyIjoiVW5saW1pdGVkIiwibmFtZSI6IkthYnVwYXRlbiBUYW5haCBEYXRhciIsImlkIjoyMDg1LCJ1dWlkIjoiNGE5N2Y1YmItODEyNy00NDMzLTg2MjItNjZlNTcxYTM0OWViIn0sImlzcyI6Imh0dHBzOlwvXC9zcGxwLmxheWFuYW4uZ28uaWQ6NDQzXC9vYXV0aDJcL3Rva2VuIiwidGllckluZm8iOnsiQnJvbnplIjp7InRpZXJRdW90YVR5cGUiOiJyZXF1ZXN0Q291bnQiLCJncmFwaFFMTWF4Q29tcGxleGl0eSI6MCwiZ3JhcGhRTE1heERlcHRoIjowLCJzdG9wT25RdW90YVJlYWNoIjp0cnVlLCJzcGlrZUFycmVzdExpbWl0IjowLCJzcGlrZUFycmVzdFVuaXQiOm51bGx9LCJVbmxpbWl0ZWQiOnsidGllclF1b3RhVHlwZSI6InJlcXVlc3RDb3VudCIsImdyYXBoUUxNYXhDb21wbGV4aXR5IjowLCJncmFwaFFMTWF4RGVwdGgiOjAsInN0b3BPblF1b3RhUmVhY2giOmZhbHNlLCJzcGlrZUFycmVzdExpbWl0IjoxMDAwMDAsInNwaWtlQXJyZXN0VW5pdCI6InNlYyJ9fSwia2V5dHlwZSI6IlBST0RVQ1RJT04iLCJwZXJtaXR0ZWRSZWZlcmVyIjoiIiwic3Vic2NyaWJlZEFQSXMiOlt7InN1YnNjcmliZXJUZW5hbnREb21haW4iOiJjYXJib24uc3VwZXIiLCJuYW1lIjoiZGlwX3RlcmJhcnUiLCJjb250ZXh0IjoiXC9kaXBfdGVyYmFydVwvMS4wIiwicHVibGlzaGVyIjoiZGlza29taW5mb190YW5haGRhdGFyIiwidmVyc2lvbiI6IjEuMCIsInN1YnNjcmlwdGlvblRpZXIiOiJVbmxpbWl0ZWQifSx7InN1YnNjcmliZXJUZW5hbnREb21haW4iOiJjYXJib24uc3VwZXIiLCJuYW1lIjoiYmVyaXRhX3RhbmFoZGF0YXJfdGVyYmFydSIsImNvbnRleHQiOiJcL2Jlcml0YV90YW5haGRhdGFyX3RlcmJhcnVcLzEuMCIsInB1Ymxpc2hlciI6ImRpc2tvbWluZm9fdGFuYWhkYXRhciIsInZlcnNpb24iOiIxLjAiLCJzdWJzY3JpcHRpb25UaWVyIjoiVW5saW1pdGVkIn0seyJzdWJzY3JpYmVyVGVuYW50RG9tYWluIjoiY2FyYm9uLnN1cGVyIiwibmFtZSI6Indpc2F0YSIsImNvbnRleHQiOiJcL3dpc2F0YVwvMS4wIiwicHVibGlzaGVyIjoiZGlza29taW5mb190YW5haGRhdGFyIiwidmVyc2lvbiI6IjEuMCIsInN1YnNjcmlwdGlvblRpZXIiOiJVbmxpbWl0ZWQifSx7InN1YnNjcmliZXJUZW5hbnREb21haW4iOiJjYXJib24uc3VwZXIiLCJuYW1lIjoiS2V1YW5nYW5OYWdhcmkiLCJjb250ZXh0IjoiXC9rZXVhbmdhbi1uYWdhcmlcLzEuMCIsInB1Ymxpc2hlciI6ImRpc2tvbWluZm9fdGFuYWhkYXRhciIsInZlcnNpb24iOiIxLjAiLCJzdWJzY3JpcHRpb25UaWVyIjoiQnJvbnplIn0seyJzdWJzY3JpYmVyVGVuYW50RG9tYWluIjoiY2FyYm9uLnN1cGVyIiwibmFtZSI6IkRhdGFQdXNkYXRpblNNUDIwMjMiLCJjb250ZXh0IjoiXC9kYXRhLXB1c2RhdGluLXNtcC0yMDIzXC8xLjAiLCJwdWJsaXNoZXIiOiJkaXNrb21pbmZvX3RhbmFoZGF0YXIiLCJ2ZXJzaW9uIjoiMS4wIiwic3Vic2NyaXB0aW9uVGllciI6IlVubGltaXRlZCJ9LHsic3Vic2NyaWJlclRlbmFudERvbWFpbiI6ImNhcmJvbi5zdXBlciIsIm5hbWUiOiJLRVBFR0FXQUlBTiIsImNvbnRleHQiOiJcL2tlcGVnYXdhaWFuXC8xLjAiLCJwdWJsaXNoZXIiOiJkaXNrb21pbmZvX3RhbmFoZGF0YXIiLCJ2ZXJzaW9uIjoiMS4wIiwic3Vic2NyaXB0aW9uVGllciI6IlVubGltaXRlZCJ9XSwidG9rZW5fdHlwZSI6ImFwaUtleSIsInBlcm1pdHRlZElQIjoiIiwiaWF0IjoxNjk3NDI3NjA0LCJqdGkiOiJiNGRmY2RkYi0wZmNiLTRmNjQtYjg3NC1hNzNiYzFhMzllZTcifQ==.ll__ZP9F2BMPAM_4irtGEU7iloaZznhn5clkzo8uZnw-jVUj_BUOWEO7KJ747MuD-I0FhtGiYQfF1rIqNXzpdOW7Dn132mKIdn_DOBhvGjHSns8-za-VuWDIoFy95c_hHxZaC3x8Kmp54BUscTNAJPKJ-xA1AYeQ4DFX39RBbxH4RXrp6y_oWxKp5MIgoQw198lWcT8M4iuPQanUYYSHh8HeH2il7osauI2p-kaaoxjmA61M_1tlVFy0CDsNQR9dTUIqvazD7n4_gqmegwXbiXTYRUmOFsI_gZDbqrdmdSmh2_ty2LbY9OYuFkJSagALCJRyg9aBWvIyiL3WubpZ4g==';
       $response = Http::
      timeout(25)
     ->withHeaders([
      'apiKey' => $apiKey,
     ])->get('https://api-splp.layanan.go.id:443/kepegawaian/1.0/get-bawahan', [
      'kode_jabatan' => $code
        ]);
        try {
            if ($response->successful()) {
                return $response->json();
            } else {
                return back()->with('error', 'Terjadi kesalahan dalam mengambil data.');
            }
        } catch (RequestException $e) {
            return back()->with('error', 'Permintaan gagal: ' . $e->getMessage());
        }
    }
    public function getEmployee($code)
    {
      return $this->fetchApiEmployee($code);
    }
    public function getSekda(){
      return $this->fetchApiEmployee("02.01. ");
    }
    //parent
    public function getKabagTata(){
      return $this->fetchApiEmployee("02.01.42.01.");
    }
    //child
    private function getKasubagAdmPemerintah(){
      return $this->fetchApiEmployee("02.01.42.01.01.");
    }
    private function getKasubagAdmKewilayahan(){
      return $this->fetchApiEmployee("02.01.42.01.02.");
    }
    private function getKasubagOtonomi(){
      return $this->fetchApiEmployee("02.01.42.01.03.");
    }
    private function getAnalisAhliMuda(){
      return $this->fetchApiEmployee("02.01.42.01.04.");
    }
    private function getAnalisDukcapil(){
      return $this->fetchApiEmployee("02.01.42.01.05.");
    }
    private function getAnalisDataInformasi(){
      return $this->fetchApiEmployee("02.01.42.01.06.");
    }



    //parent
    private function getKabagKesra(){
      return $this->fetchApiEmployee("02.01.42.02.");
    }
    //child
    private function getKasubagSpritual(){
      return $this->fetchApiEmployee("02.01.42.02.01.");
    }
    private function getKasubagSosial(){
      return $this->fetchApiEmployee("02.01.42.02.02.");
    }
    private function getKasubagMasyarakat(){
      return $this->fetchApiEmployee("02.01.42.02.03. ");
    }
    private function getPegerakSwadaya(){
      return $this->fetchApiEmployee("02.01.42.02.04.");
    }


    //parent
    private function getKepBagHukum(){
      return $this->fetchApiEmployee("02.01.42.03.");
    }
    //child
    private function getSubBagPerundangan(){
       return  $this->fetchApiEmployee("02.01.42.03.01.");
    }
    private function getSubBagBantuanHukum(){
        return $this->fetchApiEmployee("02.01.42.03.02.");
    }
    private function getSubBagDokumentasi(){
      return $this->fetchApiEmployee("02.01.42.03.03.");
    }
    private function getSubBagianAnalis(){
        return $this->fetchApiEmployee("02.01.42.03.04.");
    }

    public function getEmployeeDataByCode($code)
{
    $details = [
        'sekda' => [],
        'kabagTata' => [], 'kasubagAdmKewilayahan' => [], 'kasubagAdmPemerintah' => [],
        'kasubagOtonomi' => [], 'analisAhliMuda' => [], 'analisDukcapil' => [],
        'analisDataInformasi' => [],
        'kabagKesra' => [], 'kasubagSpritual' => [],
        'kasubagSosial' => [], 'kasubagMasyarakat' => [], 'pegerakSwadaya' => [],
        'kepSubBagHukum' => [], 'subBagHukumPerundangan' => [],
        'subBagHukumBantuan' => [], 'subBagDokumentasi' => [], 'subBagAnalis' => []
    ];

    if ($code == '02.01.42.') {
        $details = [
            'sekda' => $this->getSekda()['data']['pegawai'],
            'kabagTata' => $this->getKabagTata()['data']['pegawai'],
            'kasubagAdmKewilayahan' => $this->getKasubagAdmKewilayahan()['data']['pegawai'],
            'kasubagAdmPemerintah' => $this->getKasubagAdmPemerintah()['data']['pegawai'],
            'kasubagOtonomi' => $this->getKasubagOtonomi()['data']['pegawai'],
            'analisAhliMuda' => $this->getAnalisAhliMuda()['data']['pegawai'],
            'analisDukcapil' => $this->getAnalisDukcapil()['data']['pegawai'],
            'analisDataInformasi' => $this->getAnalisDataInformasi()['data']['pegawai'],
            'kabagKesra' => $this->getKabagKesra()['data']['pegawai'],
            'kasubagSpritual' => $this->getKasubagSpritual()['data']['pegawai'],
            'kasubagSosial' => $this->getKasubagSosial()['data']['pegawai'],
            'kasubagMasyarakat' => $this->getKasubagMasyarakat()['data']['pegawai'],
            'pegerakSwadaya' => $this->getPegerakSwadaya()['data']['pegawai'],
            'kepSubBagHukum' => $this->getKepBagHukum()['data']['pegawai'],
            'subBagHukumPerundangan' => $this->getSubBagPerundangan()['data']['pegawai'],
            'subBagHukumBantuan' => $this->getSubBagBantuanHukum()['data']['pegawai'],
            'subBagDokumentasi' => $this->getSubBagDokumentasi()['data']['pegawai'],
            'subBagAnalis' => $this->getSubBagianAnalis()['data']['pegawai'],
        ];

    }

    return [
        'data' => $this->getEmployee($code)['data']['pegawai'],
        'details' => $details

    ];
}



}
