<?php

$servername = "localhost";
$username = "root";
$password = "merdeka";
$db ="korupsi";
// Create connection
$conn = mysqli_connect($servername, $username, $password, $db);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

//master pertanyaan
function queryData(){
	global $conn;
		$ambil = mysqli_query($conn,"SELECT * FROM pertanyaan");
		return $ambil;
}

function getData2(){
	global $conn;
	$ambil=queryData();
	while ($dt = mysqli_fetch_array($ambil)){
		$hasil[]=$dt;
	}
	return $hasil;
}

function limitData($halaman_awal, $batas){
	global $conn;
		$ambil = mysqli_query($conn,"select * from pertanyaan limit $halaman_awal, $batas");
		return $ambil;
}

function tambahData($idPakan,$namaPakan,$jenisPertanyaan,$dateCreate){
	global $conn;
	$tambah= mysqli_query($conn,"INSERT INTO pertanyaan VALUES ('$idPakan', '$namaPakan', '$jenisPertanyaan','$dateCreate')");
	return $tambah;
}

function getIdPakan($id){
	global $conn;
	$ambil = mysqli_query($conn,"SELECT * FROM pertanyaan WHERE idPertanyaan='$id'");
	return $ambil;
}

function updateData($idPakan,$namaPakan,$merekPakan,$quantitiPakan){
	global $conn;
  // update data berdasarkan id_produk yg dikirimkan
  $perubahanData = $conn->query("UPDATE pertanyaan SET namaPertanyaan = '$namaPakan', jenisPertanyaan = '$merekPakan', dateCreate = '$quantitiPakan' WHERE idPertanyaan = '$idPakan'");

  if ($perubahanData) {
    // pesan jika data berubah
    echo "<script>alert('Data berhasil diubah'); window.location.href='pertanyaan.php'</script>";
  } else {
    // pesan jika data gagal diubah
    echo "<script>alert('Data gagal diubah'); window.location.href='pertanyaan.php'</script>";
  }
}

function hapusData($idPakan){
	global $conn;
	 //jalankan query DELETE untuk menghapus data
    $hapusPakan = "DELETE FROM pertanyaan WHERE idPertanyaan='$idPakan'";
    $hasil_query = mysqli_query($conn, $hapusPakan);
	
    //periksa query, apakah ada kesalahan
    if(!$hasil_query) {
      die ("Gagal menghapus data: ".mysqli_errno($conn).
       " - ".mysqli_error($conn));
    } else {
      echo "<script>alert('Data berhasil dihapus.');window.location='pertanyaan.php';</script>";
    }
}

//master responden
function queryResponden(){
	global $conn;
		$ambil = mysqli_query($conn,"SELECT * FROM responden");
		return $ambil;
}

function getResponden(){
	global $conn;
	$ambil=queryData();
	while ($dt = mysqli_fetch_array($ambil)){
		$hasil[]=$dt;
	}
	return $hasil;
}

function limitResponden($halaman_awal, $batas){
	global $conn;
		$ambil = mysqli_query($conn,"select * from responden limit $halaman_awal, $batas");
		return $ambil;
}

function getIdResponden($id){
	global $conn;
	$ambil = mysqli_query($conn,"SELECT * FROM responden WHERE idResponden='$id'");
	return $ambil;
}

function updateResponden($idPakan,$namaPakan,$merekPakan,$phoneResponden,$quantitiPakan,$perusahaanResponden){
	global $conn;
  // update data berdasarkan id_produk yg dikirimkan
  $perubahanData = $conn->query("UPDATE responden SET namaResponden = '$namaPakan', profesiResponden = '$merekPakan', phoneResponden='$phoneResponden', emailResponden = '$quantitiPakan', perusahaanResponden='$perusahaanResponden' WHERE idResponden = '$idPakan'");

  if ($perubahanData) {
    // pesan jika data berubah
    echo "<script>alert('Data responden berhasil diubah'); window.location.href='responden.php'</script>";
  } else {
    // pesan jika data gagal diubah
    echo "<script>alert('Data responden gagal diubah'); window.location.href='responden.php'</script>";
  }
}

function hapusResponden($idPakan){
	global $conn;
	 //jalankan query DELETE untuk menghapus data
    $hapusPakan = "DELETE hasil, responden, komentar FROM hasil LEFT JOIN responden ON hasil.idResponden = responden.idResponden LEFT JOIN komentar ON hasil.idResponden = komentar.idResponden WHERE hasil.idResponden = '$idPakan'";
    $hasil_query = mysqli_query($conn, $hapusPakan);
	
    //periksa query, apakah ada kesalahan
    if(!$hasil_query) {
      die ("Gagal menghapus data: ".mysqli_errno($conn).
       " - ".mysqli_error($conn));
    } else {
      echo "<script>alert('Data berhasil dihapus.');window.location='responden.php';</script>";
    }
}


?>