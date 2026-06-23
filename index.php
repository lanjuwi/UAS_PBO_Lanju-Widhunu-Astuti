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



// ambil data karyawan
$query = mysqli_query(
    $conn,
    "SELECT * FROM tabel_karyawan"
);



$kontrak = [];
$tetap = [];
$magang = [];



// membuat object berdasarkan jenis karyawan

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


        $kontrak[] = $obj;



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


        $tetap[] = $obj;




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


        $magang[] = $obj;


    }


}





// fungsi menampilkan data

function tampilkan($judul,$list)
{


echo "

<h2>$judul</h2>


<table>


<tr>

<th>ID Karyawan</th>
<th>Nama</th>
<th>Departemen</th>
<th>Hari Kerja</th>
<th>Slip Gaji Bersih</th>

</tr>

";




foreach($list as $k){



echo "

<tr>


<td>
".$k->getIdKaryawan()."
</td>


<td>
".$k->getNamaKaryawan()."
</td>


<td>
".$k->getDepartemen()."
</td>


<td>
".$k->getHariKerja()." hari
</td>


<td>
Rp ".number_format(
$k->hitungGajiBersih()
)."
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
padding:30px;
border-radius:15px;
box-shadow:0 5px 15px #ccc;

}



h1{

text-align:center;
color:#34495e;

}



h2{

margin-top:40px;
color:#2c3e50;

}



table{

width:100%;
border-collapse:collapse;
margin-top:15px;

}



th{

background:#34495e;
color:white;
padding:12px;

}



td{

border:1px solid #ccc;
padding:12px;
text-align:center;

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