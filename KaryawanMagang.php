<?php

require_once "Karyawan.php";


class KaryawanMagang extends Karyawan
{


    protected $uang_saku_bulanan;
    protected $sertifikat_kampus_merdeka;



    public function __construct(
        $id_karyawan,
        $nama_karyawan,
        $departemen,
        $hari_kerja_masuk,
        $gaji_dasar_per_hari,
        $uang_saku_bulanan,
        $sertifikat_kampus_merdeka
    ){


        parent::__construct(
            $id_karyawan,
            $nama_karyawan,
            $departemen,
            $hari_kerja_masuk,
            $gaji_dasar_per_hari
        );


        $this->uang_saku_bulanan = $uang_saku_bulanan;
        $this->sertifikat_kampus_merdeka = $sertifikat_kampus_merdeka;

    }






    public function hitungGajiBersih()
    {

        return 

        (
            (int)$this->hari_kerja_masuk *
            (int)$this->gaji_dasar_per_hari
        )

        * 0.8;

    }






    public function gajiDasarPerHari()
    {
        return (int)$this->gaji_dasar_per_hari;
    }





    public function getUangSaku()
    {
        return $this->uang_saku_bulanan;
    }





    public function getSertifikat()
    {
        return $this->sertifikat_kampus_merdeka;
    }



}

?>