<?php

require_once "Karyawan.php";
require_once "KaryawanKontrak.php";
require_once "KaryawanTetap.php";
require_once "KaryawanMagang.php";



// ========================
// KONEKSI DATABASE
// ========================

$conn = mysqli_connect(
    "localhost",
    "root",
    "",
    "db_uas_pbo_trpl1b_lanjuwidhunuastuti"
);


if(!$conn){
    die("Koneksi gagal : ".mysqli_connect_error());
}




// ========================
// AMBIL DATA
// ========================

$query = mysqli_query(
    $conn,
    "SELECT * FROM tabel_karyawan"
);



$kontrak = [];
$tetap = [];
$magang = [];





// ========================
// BUAT OBJECT
// ========================


while($data = mysqli_fetch_assoc($query)){


    $jenis = strtolower(
        trim($data['jenis_karyawan'])
    );



    if($jenis == "kontrak"){


        $kontrak[] = new KaryawanKontrak(

            $data['id_karyawan'],
            $data['nama_karyawan'],
            $data['departemen'],
            $data['hari_kerja_masuk'],
            $data['gaji_dasar_per_hari'],
            $data['durasi_kontrak_bulan'],
            $data['agensi_penyalur']

        );


    }



    elseif($jenis == "tetap"){



        $tetap[] = new KaryawanTetap(

            $data['id_karyawan'],
            $data['nama_karyawan'],
            $data['departemen'],
            $data['hari_kerja_masuk'],
            $data['gaji_dasar_per_hari'],
            $data['tunjangan_kesehatan'],
            $data['opsi_saham_id']

        );


    }




    elseif($jenis == "magang"){



        $magang[] = new KaryawanMagang(

            $data['id_karyawan'],
            $data['nama_karyawan'],
            $data['departemen'],
            $data['hari_kerja_masuk'],
            $data['gaji_dasar_per_hari'],
            $data['uang_saku_bulanan'],
            $data['sertifikat_kampus_merdeka']

        );


    }


}







// ========================
// FUNCTION TAMPIL
// ========================


function tampilkan($judul,$icon,$data,$jenis)
{


?>


<div class="card">


<h2>
<?= $icon ?> <?= $judul ?>
</h2>



<table>


<tr>

<th>ID</th>
<th>Nama</th>
<th>Departemen</th>
<th>Hari Kerja</th>
<th>Gaji Bersih</th>
<th>Spesifikasi</th>

</tr>



<?php foreach($data as $k): ?>

<tr>


<td>

<?= $k->getIdKaryawan(); ?>

</td>



<td>

<?= $k->getNamaKaryawan(); ?>

</td>




<td>

<?= $k->getDepartemen(); ?>

</td>




<td>

<?= $k->getHariKerja(); ?> Hari

</td>




<td>

Rp <?= number_format(
$k->hitungGajiBersih()
); ?>

</td>




<td>


<?php



if($jenis=="kontrak"){


echo "

Durasi : ".$k->getDurasiKontrak()." Bulan
<br>

Agensi : ".$k->getAgensiPenyalur();


}





elseif($jenis=="tetap"){


echo "

Tunjangan : Rp ".
number_format(
$k->getTunjanganKesehatan()
)

."<br>

Saham : ".$k->getOpsiSaham();


}





elseif($jenis=="magang"){


echo "

Uang Saku : Rp ".
number_format(
$k->getUangSaku()
)

."<br>

Sertifikat : ".$k->getSertifikat();


}


?>


</td>



</tr>



<?php endforeach; ?>



</table>



</div>



<?php

}



?>





<!DOCTYPE html>

<html>


<head>


<title>
Slip Gaji Karyawan
</title>



<style>


body{

font-family:Arial;
background:#eef2f7;
padding:30px;

}



.container{

background:white;
padding:30px;
border-radius:20px;

}



h1{

text-align:center;
color:#34495e;

}



.card{

margin-top:35px;
background:#fafafa;
padding:20px;
border-radius:15px;

}



table{

width:100%;
border-collapse:collapse;

}



th{

background:#34495e;
color:white;
padding:12px;

}



td{

border:1px solid #ddd;
padding:12px;
text-align:center;

}



tr:hover{

background:#e8f3ff;

}



</style>


</head>




<body>



<div class="container">



<h1>
📄 SISTEM INFORMASI SLIP GAJI KARYAWAN
</h1>



<p style="text-align:center">

Data Dinamis Database MySQL <br>

Inheritance & Polymorphism

</p>




<?php


tampilkan(
"Karyawan Kontrak",
"👷",
$kontrak,
"kontrak"
);



tampilkan(
"Karyawan Tetap",
"🏢",
$tetap,
"tetap"
);



tampilkan(
"Karyawan Magang",
"🎓",
$magang,
"magang"
);



?>



</div>



</body>

</html>