<?php

require_once "Karyawan.php";


class KaryawanTetap extends Karyawan
{

    protected $tunjangan_kesehatan;
    protected $opsi_saham_id;



    public function __construct(
        $id_karyawan,
        $nama_karyawan,
        $departemen,
        $hari_kerja_masuk,
        $gaji_dasar_per_hari,
        $tunjangan_kesehatan,
        $opsi_saham_id
    ){

        parent::__construct(
            $id_karyawan,
            $nama_karyawan,
            $departemen,
            $hari_kerja_masuk,
            $gaji_dasar_per_hari
        );


        $this->tunjangan_kesehatan = $tunjangan_kesehatan;
        $this->opsi_saham_id = $opsi_saham_id;

    }




    public function hitungGajiBersih()
    {

        return 
        (
            (int)$this->hari_kerja_masuk *
            (int)$this->gaji_dasar_per_hari
        )
        +
        (int)$this->tunjangan_kesehatan;

    }




    public function gajiDasarPerHari()
    {
        return (int)$this->gaji_dasar_per_hari;
    }

}

?>