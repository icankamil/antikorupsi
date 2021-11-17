<?php
// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if($_SESSION["loggedin"] === false){
    header("location: admin.php");
    exit;
}
 
 // Include config file
require_once "koneksi.php";

		$dataPakan= getResponden();
		$dataJumlah= queryResponden();

    $no = 1; // nomor urut
	
	$batas = 10;
	$halaman = isset($_GET['halaman'])?(int)$_GET['halaman'] : 1;
	$halaman_awal = ($halaman>1) ? ($halaman * $batas) - $batas : 0;	
	$previous = $halaman - 1;
	$next = $halaman + 1;
	$jumlah_data = mysqli_num_rows($dataJumlah);
	$total_halaman = ceil($jumlah_data/$batas);
	$limitData=limitResponden($halaman_awal, $batas);
	$data_pakan = $limitData;
	$nomor = $halaman_awal+1;

//ubah data produk
if (isset($_POST['edit'])) {
  $namaResponden = $_POST['namaResponden'];
  $profesiResponden = $_POST['profesiResponden'];
  $phoneResponden = $_POST['phoneResponden'];
  $emailResponden = $_POST['emailResponden'];
  $perusahaanResponden = $_POST['perusahaanResponden'];
  $dateCreate = date("Y-m-d");
  $idPakan = $_POST['idResponden'];
  $updateResponden = updateResponden($idPakan,$namaResponden,$profesiResponden,$phoneResponden,$emailResponden,$perusahaanResponden);
}

if (isset($_POST['hapus'])) {
$id = $_POST["idResponden"];
//mengambil id yang ingin dihapus
$hapusResponden=hapusResponden($id);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Aplikasi Persepsi Antikorupsi">
	<meta name="author" content="TMK Group">
	<meta name="keywords" content="Antikorupsi, BBK, Balai, Besar, Keramik, KEMENPERIN">

	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="shortcut icon" href="img/icons/icon-48x48.png" />

	<title>Dashboard Anti Korupsi</title>

	<link href="css/app.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
</head>

<body>
	<div class="wrapper">
		<nav id="sidebar" class="sidebar">
			<div class="sidebar-content js-simplebar">
				<a class="sidebar-brand" href="index.html">
          <span class="align-middle">Dashboard AntiKorupsi</span>
        </a>

				<ul class="sidebar-nav">
					<li class="sidebar-header">
						Utama
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="akumulasi.php">
              <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Akumulasi</span>
            </a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="pertanyaan.php">
              <i class="align-middle" data-feather="user"></i> <span class="align-middle">Master Pertanyaan</span>
            </a>
					</li>
					
					<li class="sidebar-item">
						<a class="sidebar-link" href="detail-akumulasi.php">
              <i class="align-middle" data-feather="clipboard"></i> <span class="align-middle">Detail Akumulasi</span>
            </a>
					</li>
					
					<li class="sidebar-item active">
						<a class="sidebar-link" href="responden.php">
              <i class="align-middle" data-feather="users"></i> <span class="align-middle">Responden</span>
            </a>
					</li>
			</div>
		</nav>

		<div class="main">
			<nav class="navbar navbar-expand navbar-light navbar-bg">
				<a class="sidebar-toggle d-flex">
          <i class="hamburger align-self-center"></i>
        </a>

				<div class="navbar-collapse collapse">
					<ul class="navbar-nav navbar-align">
						<li class="nav-item dropdown">
							<a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
                <i class="align-middle" data-feather="settings"></i>
              </a>

							<a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
                <img src="img/avatars/avatar.jpg" class="avatar img-fluid rounded me-1" alt="Charles Hall" /> <span class="text-dark"><?php echo $_SESSION['username'];?></span>
              </a>
							<div class="dropdown-menu dropdown-menu-end">
								<a class="dropdown-item" href="logout.php">Log out</a>
							</div>
						</li>
					</ul>
				</div>
			</nav>

			<main class="content">
				<div class="container-fluid p-0">

					<div class="row mb-2 mb-xl-3">
						<div class="col-auto d-none d-sm-block">
							<h3><strong>Responden</strong> Anti-Korupsi</h3>
						</div>
					</div>
					<div class="row">
						<div class="col-xl-12 col-xxl-12">
							<div class="card flex-fill w-100">
								<div class="card-header">
									<h5 class="card-title mb-0">Detail Responden</h5>
								</div>
								<div class="card-body py-3">
									<div class="table-responsive">
										<table class="table table-hover my-0 mx-0">
											<thead>
												<tr>
													<th>No</th>
													<th>Nama</th>
													<th>Jabatan</th>
													<th>Telpon</th>
													<th>Email</th>
													<th>Perusahaan</th>
													<th>Aksi</th>
													<th>Tanggal Isi</th>
												</tr>
											</thead>
											<tbody>
									<?php
		  if(!isset($dataPakan)){
			  
			  echo "<h2 class='text-center'> Belum ada data</h2>";
		  }else{
while($row=mysqli_fetch_array($limitData)){
 ?> 
    <tr>
      <th><?php print($no++); ?></th>
      <td><?php print($row['namaResponden']);?></td>
      <td><?php print($row['profesiResponden']); ?></td>
      <td><?php print($row['telponResponden']); ?></td>
      <td><?php print($row['emailResponden']); ?></td>
      <td><?php print($row['perusahaanResponden']); ?></td>
	  <td><button type="button" id="<?php print($row['idResponden'])?>" class="ubah-responden btn btn-warning" data-toggle="modal" data-target="#editModal"><i class="edit align-self-center"></i> Edit</button>
	  <button type="button" id="<?php print($row['idResponden'])?>" class="hapus-responden btn btn-danger" data-toggle="modal" data-target="#hapusModal"><i class="delete align-self-center"></i> Hapus</button></td>
	  <td><?php print($row['dateCreate']); ?></td>
    </tr>
		  <?php }
		  }?>
									</tbody>
										</table>
									</div>
								</div>
							</div>
							<div class="pagination">
		  <a class="page" <?php if($halaman > 1){ echo "href='?halaman=$previous'"; } ?>>Previous</a><?php 
				for($x=1;$x<=$total_halaman;$x++){
					?> 
					<a class="page" href="?halaman=<?php echo $x ?>"><?php echo $x; ?></a>
					<?php
				}
				?>	<a class="page" <?php if($halaman < $total_halaman) { echo "href='?halaman=$next'"; } ?>>Next</a>
	</div>
						</div>
					</div>

<!-- Tambah Data -->
<div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
     <div class="row">
					<div class="col-12 col-lg-12">
							<div class="card">
								<div class="card-header">
									<h5 class="card-title mb-0">Tambah Data</h5>
								</div>
								<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
								<div class="card-body">
									<input type="text" class="form-control mb-3" placeholder="Nama Pertanyaan" name="namaPertanyaan">
									<span>Jenis Pertanyaan : </span>
									<div>
										<label class="form-check">
            <input class="form-check-input" type="radio" value="pilihan" name="jenisPertanyaan" checked>
            <span class="form-check-label">
              Pilihan
            </span>
          </label>
										<label class="form-check">
            <input class="form-check-input" type="radio" value="essai" name="jenisPertanyaan">
            <span class="form-check-label">
              Essai
            </span>
          </label>
									</div>
								</div>
								<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary" name="tambah">Tambah</button>
							</div>
						</div>
					</div>
	  </form>
    </div>
  </div>
</div>

<!-- Tambah Data -->

<!-- Edit Data -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
     <div class="row">
	 <div class="modal-body" id="dataResponden">
      </div>		
					</div>
	  </form>
    </div>
  </div>
</div>

<!-- Edit Data -->

<!-- Hapus Data -->
<div class="modal fade" id="hapusModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
     <div class="row">
	  <div class="modal-body" id="dataPakan">
      </div>
					</div>
	  </form>
    </div>
  </div>
</div>

<!-- Hapus Data -->
				</div>
			</main>

			<footer class="footer">
				<div class="container-fluid">
					<div class="row text-muted">
						<div class="col-6 text-start">
							<p class="mb-0">
								<a href="index.html" class="text-muted"><strong>Balai Besar Keramik</strong></a> &copy; <?php print_r(date('Y'));?>
							</p>
						</div>
						<div class="col-6 text-end">
							<ul class="list-inline">
								<li class="list-inline-item">
									<a class="text-muted" href="#">Support</a>
								</li>
								<li class="list-inline-item">
									<a class="text-muted" href="#">Help Center</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</footer>
		</div>
	</div>

	<script src="js/app.js"></script>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
	<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js" integrity="sha256-eGE6blurk5sHj+rmkfsGYeKyZx3M4bG+ZlFyA7Kns7E=" crossorigin="anonymous"></script>
<script src="js/dashboard.js"></script>

</body>

</html>