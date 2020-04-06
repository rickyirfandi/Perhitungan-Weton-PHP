<?php
//Get input from index
$nama1 = $_POST['nama1'];
$tglLahir1 = $_POST['birthday1'];
$nama2 = $_POST['nama2'];
$tglLahir2 = $_POST['birthday2'];

//format date
$tglLahirFormated1 = str_replace('/', '-', $tglLahir1);
$tglLahirFormated1 = date("Y/m/d", strtotime($tglLahirFormated1) );
$tglLahirFormated2 = str_replace('/', '-', $tglLahir2);
$tglLahirFormated2 = date("Y/m/d", strtotime($tglLahirFormated2) );

//get day from date
$namahari1 = date('l', strtotime($tglLahirFormated1));
$namahari2 = date('l', strtotime($tglLahirFormated2));

//translate day to indonesian
$daftar_hari = array(
 'Sunday' => 'Minggu',
 'Monday' => 'Senin',
 'Tuesday' => 'Selasa',
 'Wednesday' => 'Rabu',
 'Thursday' => 'Kamis',
 'Friday' => 'Jumat',
 'Saturday' => 'Sabtu'
);
$namahari1 = $daftar_hari[$namahari1];
$namahari2 = $daftar_hari[$namahari2];
$harijawa1 = AmbilHariJawa($tglLahirFormated1);
$harijawa2 = AmbilHariJawa($tglLahirFormated2);

$neptuHari1 = AmbilNeptuHari($namahari1);
$neptuHari2 = AmbilNeptuHari($namahari2);

$neptuPasaran1 = AmbilNeptuPasaran($harijawa1);
$neptuPasaran2 = AmbilNeptuPasaran($harijawa2);

$hasil = ($neptuHari1 + $neptuPasaran1) + ($neptuHari2 + $neptuPasaran2);

function AmbilNeptuHari($hari)
 {
  $daftar_neptu = array(
   'Minggu' => '5',
   'Senin' => '4',
   'Selasa' => '3',
   'Rabu' => '7',
   'Kamis' => '8',
   'Jumat' => '6',
   'Sabtu' => '9'
  );
  return $daftar_neptu[$hari];
}

function AmbilNeptuPasaran($pasaran) {
  $daftar_neptu = array(
   'Legi' => '5',
   'Pahing' => '9',
   'Pon' => '7',
   'Wage' => '4',
   'Kliwon' => '8'
  );
  return $daftar_neptu[$pasaran];
}

function AmbilHariJawa($tanggal) {
  // dipilih tanggal 2 Januari 1900 sebagai acuan
  // hari pasaran tanggal  Januari 1900 adalah 'Pon'
  $tgl1 = "1900/01/02";

  // array urutan nama hari pasaran dimulai dari 'Pon'
  $pasaran = array('Pon', 'Wage', 'Kliwon', 'Legi', 'Pahing');

  // proses mencari selisih hari antara kedua tanggal
  $pecah1 = explode("/", $tgl1);
  $date1 = $pecah1[2];
  $month1 = $pecah1[1];
  $year1 = $pecah1[0];

  $pecah2 = explode("/", $tanggal);
  $date2 = $pecah2[2];
  $month2 = $pecah2[1];
  $year2 =  $pecah2[0];

  $jd1 = GregorianToJD($month1, $date1, $year1);
  $jd2 = GregorianToJD($month2, $date2, $year2);

  $selisih = $jd2 - $jd1;
  // hitung modulo 5 dari selisih harinya
  $mod = $selisih % 5;
  // mereturn nama hari pasaran, yaitu elemen ke-$mod dari array $pasaran
    return $pasaran[$mod];
}

$judulHasil = "";
$Deskripsi = "";

if($hasil=='1'||$hasil=='9'||$hasil=='10'||$hasil=='18'||$hasil=='19'||$hasil=='27'||$hasil=='28'||$hasil=='36'){
  $judulHasil = "PEGAT";
  $Deskripsi = "Masalah yang sering ditemui oleh pasangan PEGAT ini di kemudian hari mulai dari masalah ekonomi, kekuasaan, perselingkuhan yang bisa menyebabkan pasangan tersebut bercerai atau pegatan.";
};

if($hasil=='2'||$hasil=='11'||$hasil=='20'||$hasil=='29'){
  $judulHasil = "RATU";
  $Deskripsi = "Bisa dibilang pasangan tersebut memang sudah jodohnya. Dihargai dan disegani oleh tetangga dan lingkungan sekitar. Saking harmonisnya, bahkan banyak orang yang iri akan keharmonisannya dalam membina rumah tangga.";
};

if($hasil=='3'||$hasil=='12'||$hasil=='21'||$hasil=='30'){
  $judulHasil = "JODOH";
  $Deskripsi = "Pasangan tersebut memang beneran cocok dan berjodoh. Pasangan ini bisa saling menerima segala kelebihan dan kekurangan masing-masing. Rumah tangga pasangan JODOH ini bisa rukun sampai tua.";
};

if($hasil=='4'||$hasil=='13'||$hasil=='22'||$hasil=='31'){
  $judulHasil = "TOPO";
  $Deskripsi = "Dalam membina rumah tangga, pasangan TOPO akan sering mengalami kesusahan di awal musim karena masih saling memahami tapi akan bahagia pada akhirnya. Masalah yang dihadapi bisa saja soal ekonomi dan lainnya. Nah, saat sudah memiliki anak dan cukup lama berumah tangga, akhirnya akan hidup sukses dan bahagia.";
};

if($hasil=='5'||$hasil=='14'||$hasil=='23'||$hasil=='32'){
  $judulHasil = "TINARI";
  $Deskripsi = "Pasangan TINARI akan menemukan kebahagiaan. Dalam mencari rezeki diberikan kemudahan dan nggak sampai hidup kekurangan. Selain itu, hidupnya juga sering mendapat keberuntungan.";
};

if($hasil=='6'||$hasil=='15'||$hasil=='24'||$hasil=='33'){
  $judulHasil = "PADU";
  $Deskripsi = "Dalam berumah tangga, pasangan PADU akan sering mengalami pertengkaran. Tapi Bela, meskipun sering bertengkar, nggak sampai cerai. Masalah pertengkaran tersebut bahkan bisa dipicu dari hal-hal yang sifatnya cukup sepele.";
};

if($hasil=='7'||$hasil=='16'||$hasil=='25'||$hasil=='34'){
  $judulHasil = "SUJANAN";
  $Deskripsi = "Dalam berumah tangga, pasangan SUJANAN akan sering mengalami pertengkaran dan masalah perselingkuhan. Bisa itu dari pihak laki-laki maupun perempuan yang memulai perselingkuhan tersebut.";
};

if($hasil=='8'||$hasil=='17'||$hasil=='26'||$hasil=='35'){
  $judulHasil = "PESTHI";
  $Deskripsi = "Dalam berumah tangga, pasangan PESTHI akan rukun, tenteram, damai sampai tua. Meskipun ada masalah apapun nggak akan sampai merusak keharmonisan keluarga.";
};

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Perhitungan Weton">
    <meta name="author" content="Ricky Irfandi">

    <!-- Title Page-->
    <title>Hasil Test</title>

    <!-- Icons font CSS-->
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <!-- Font special for pages-->
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Vendor CSS-->
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/datepicker/daterangepicker.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="css/main.css" rel="stylesheet" media="all">
</head>

<body>
    <div class="page-wrapper bg-gra-02 p-t-100 p-b-100 font-poppins">
        <div class="wrapper wrapper--w680">
            <div class="card card-4">
                <div class="card-body">
                    <h1 class="title"><?php echo $judulHasil?></h1>
                    <?php echo "Jadi, si ".$nama1." yang lahir di hari ".$namahari1." ".$harijawa1." dengan si ".$nama2." yang lahir di hari ".$namahari2." ".$harijawa2." kalau dihitung wetonnya hasilnya ".$judulHasil.". Apa sih maksudnya?"?>
                      <br><br><?php echo $Deskripsi?><br>
                            <br><br><br>
                            <form action="index.html">
                                <button class="btn btn--radius-2 btn--blue btn-lg btn-block" type="submit"> Test Lagi →</button>
                            </form>
                </div>
            </div>
            <br>
        </div>
    </div>


    <!-- Jquery JS-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <!-- Vendor JS-->
    <script src="vendor/select2/select2.min.js"></script>
    <script src="vendor/datepicker/moment.min.js"></script>
    <script src="vendor/datepicker/daterangepicker.js"></script>

    <!-- Main JS-->
    <script src="js/global.js"></script>

</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>
<!-- end document-->
