<?php

require_once "Karyawan.php";
require_once "KaryawanKontrak.php";
require_once "KaryawanTetap.php";
require_once "KaryawanMagang.php";


// koneksi database
$conn = mysqli_connect(
    "localhost",
    "root",
    "",
    "db_uas_pbo_trpl1b_lanjuwidhunuastuti"
);


if(!$conn){
    die("Koneksi gagal : ".mysqli_connect_error());
}



// ambil data
$query = mysqli_query(
    $conn,
    "SELECT * FROM tabel_karyawan"
);



$kontrak = [];
$tetap = [];
$magang = [];



// ubah data database jadi object

while($data = mysqli_fetch_assoc($query)){


    if($data['jenis_karyawan']=="Kontrak"){


        $obj = new KaryawanKontrak(
            $data['id_karyawan'],
            $data['nama_karyawan'],
            $data['departemen'],
            $data['hari_kerja_masuk'],
            $data['gaji_dasar_per_hari'],
            $data['durasi_kontrak_bulan'],
            $data['agensi_penyalur']
        );


        $kontrak[]=$obj;


    }



    elseif($data['jenis_karyawan']=="Tetap"){


        $obj = new KaryawanTetap(
            $data['id_karyawan'],
            $data['nama_karyawan'],
            $data['departemen'],
            $data['hari_kerja_masuk'],
            $data['gaji_dasar_per_hari'],
            $data['tunjangan_kesehatan'],
            $data['opsi_saham_id']
        );


        $tetap[]=$obj;


    }




    elseif($data['jenis_karyawan']=="Magang"){


        $obj = new KaryawanMagang(
            $data['id_karyawan'],
            $data['nama_karyawan'],
            $data['departemen'],
            $data['hari_kerja_masuk'],
            $data['gaji_dasar_per_hari'],
            $data['uang_saku_bulanan'],
            $data['sertifikat_kampus_merdeka']
        );


        $magang[]=$obj;

    }

}




function tampilkan($judul,$list)
{

echo "

<h2>$judul</h2>


<table>

<tr>
<th>ID</th>
<th>Nama</th>
<th>Departemen</th>
<th>Hari Masuk</th>
<th>Gaji Bersih</th>
</tr>

";



foreach($list as $k){


echo "

<tr>

<td>$k->id_karyawan</td>

<td>$k->nama_karyawan</td>

<td>$k->departemen</td>

<td>$k->hari_kerja_masuk hari</td>

<td>
Rp ".number_format($k->hitungGajiBersih())."
</td>


</tr>

";


}



echo "</table>";

}



?>



<!DOCTYPE html>

<html>


<head>

<title>Slip Gaji Karyawan</title>


<style>


body{
font-family:Arial;
background:#eef2f7;
padding:30px;
}


.container{
background:white;
padding:25px;
border-radius:15px;
}


h1{
text-align:center;
color:#2c3e50;
}


h2{
margin-top:35px;
color:#34495e;
}


table{

width:100%;
border-collapse:collapse;

}


td,th{

border:1px solid #ccc;
padding:10px;
text-align:center;

}


th{

background:#34495e;
color:white;

}


</style>


</head>



<body>


<div class="container">


<h1>
📄 DAFTAR SLIP GAJI KARYAWAN
</h1>



<?php


tampilkan(
"👷 KARYAWAN KONTRAK",
$kontrak
);



tampilkan(
"🏢 KARYAWAN TETAP",
$tetap
);



tampilkan(
"🎓 KARYAWAN MAGANG",
$magang
);



?>


</div>


</body>


</html>