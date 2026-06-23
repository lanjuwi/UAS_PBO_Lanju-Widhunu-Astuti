<?php

require_once "Karyawan.php";

class KaryawanKontrak extends Karyawan
{

    protected $durasi_kontrak_bulan;
    protected $agensi_penyalur;


    public function __construct(
        $id_karyawan,
        $nama_karyawan,
        $departemen,
        $hari_kerja_masuk,
        $gaji_dasar_per_hari,
        $durasi_kontrak_bulan,
        $agensi_penyalur
    ){

        parent::__construct(
            $id_karyawan,
            $nama_karyawan,
            $departemen,
            $hari_kerja_masuk,
            $gaji_dasar_per_hari
        );


        $this->durasi_kontrak_bulan = $durasi_kontrak_bulan;
        $this->agensi_penyalur = $agensi_penyalur;

    }



    // overriding
    public function hitungGajiBersih()
    {

        return 
        (int)$this->hari_kerja_masuk *
        (int)$this->gaji_dasar_per_hari;

    }



    public function gajiDasarPerHari()
    {
        return (int)$this->gaji_dasar_per_hari;
    }

}

?>