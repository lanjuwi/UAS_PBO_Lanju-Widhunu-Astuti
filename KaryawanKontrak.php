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



    public function hitungGajiBersih()
    {
        return $this->gaji_dasar_per_hari * 26;
    }



    public function gajiDasarPerHari()
    {
        return $this->gaji_dasar_per_hari;
    }

}

?>