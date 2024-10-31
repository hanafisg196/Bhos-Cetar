<?php
namespace App\Services;
interface EmployeeService {

    //fetch employee api method
    public function getEmployee($code);

    public function getKabagTata();
    public function getKasubagAdmPemerintah();
    public function getKasubagAdmKewilayahan();
    public function getKasubagOtonomi();
    public function getAnalisAhliMuda();
    public function getAnalisDukcapil();
    public function getAnalisDataInformasi();

    public function getKabagKesra();
    public function getKasubagSpritual();
    public function getKasubagSosial();
    public function getKasubagMasyarakat();
    public function getPegerakSwadaya();

    public function getKepBagHukum();
    public function getSubBagPerundangan();
    public function getSubBagBantuanHukum();
    public function getSubBagDokumentasi();
    public function getSubBagianAnalis();
}
