<?php
// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if($_SESSION["loggedin"] === false){
    header("location: admin.php");
    exit;
}
 
// Include config file
require "function/akumulasi.php";



$indexFunc = indexFunc();
if (isset($_POST['submit'])) {
	$indexFunc = indexFunc($_POST['tgl_mulai'], $_POST['tgl_berakhir']);
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
          <span class="align-middle">AdminKit</span>
        </a>

				<ul class="sidebar-nav">
					<li class="sidebar-header">
						Utama
					</li>

					<li class="sidebar-item active">
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
					
					<li class="sidebar-item">
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

				<form class="d-none d-sm-inline-block" method="POST" action="">
					<div class="input-group input-group-navbar">
						<input type="text" class="form-control datepicker" placeholder="Dari Tanggal" aria-label="Search" name="tgl_mulai" autocomplete="off" value="<?php echo isset($_POST['tgl_mulai']) ?  $_POST['tgl_mulai'] : '' ?>"> 
						<input type="text" class="form-control datepicker" placeholder="Sampai Tanggal" aria-label="Search" name="tgl_berakhir" autocomplete="off" value="<?php echo isset($_POST['tgl_berakhir']) ? $_POST['tgl_berakhir'] : '' ?>"> 
						<button class="btn" type="submit" name="submit">
						<i class="align-middle" data-feather="search"></i>
						</button>
					</div>
				</form>

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
							<h3><strong>Akumulasi</strong> Anti-Korupsi</h3>
						</div>
					</div>
					
					<div class="row">
						<div class="col-12 col-md-12">
							<div class="card flex-fill w-100">
								<div class="card-header">
									<h5 class="card-title mb-0">Rekap Persepsi Korupsi</h5>
								</div>
								<div class="card-body">
									<h3 class="text-center">INDEKS PERSEPSI KORUPSI</h3>
									<h3 class="text-center">BALAI BESAR KERAMIK</h3>
									<h5 class="text-center">PERIODE 
										<?php 
											echo isset($_POST['tgl_mulai']) && $_POST['tgl_mulai'] != '' ? 
											(date('d M Y', strtotime($_POST['tgl_mulai'])) ." s/d ". (isset($_POST['tgl_berakhir']) && $_POST['tgl_berakhir'] != '' ? date('d M Y', strtotime($_POST['tgl_berakhir'])) : date('d M Y') ))
											: (date('d M Y', strtotime($indexFunc['hasil'][0]['dateCreate'])) ." s/d ". date('d M Y', strtotime($indexFunc['hasil'][26]['dateCreate'])) );
										?>
									</h5>
									<div class="row justify-content-around mt-3">
									<div class="col-4 border">
									<h5 class="text-center border-bottom pt-3">Nilai Indeks</h5>
									<h1 class="display-1 text-center py-3"><?php echo number_format($indexFunc['totalNilai'],2,',',','); ?></h1>
									<h1 class="display-6 text-center pb-2">KATEGORI MUTU : <strong><?php echo $indexFunc['kategori_mutu']; ?></strong></h1>
									</div>
									<div class="col-6 border">
									<h5 class="text-center border-bottom pt-3">Data Responden</h5>
									<h1 class="display-6 text-center p-5">Jumlah Responden : <br><?php echo $indexFunc['count_responden']; ?> Orang</h1>
									</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-xl-12 col-xxl-12">
							<div class="card flex-fill w-100">
								<div class="card-header">

									<h5 class="card-title mb-0">Hasil Kuisioner</h5>
									<h5>PERIODE 
										<?php 
											echo isset($_POST['tgl_mulai']) && $_POST['tgl_mulai'] != '' ? 
											(date('d M Y', strtotime($_POST['tgl_mulai'])) ." s/d ". (isset($_POST['tgl_berakhir']) && $_POST['tgl_berakhir'] != '' ? date('d M Y', strtotime($_POST['tgl_berakhir'])) : date('d M Y') ))
											: (date('d M Y', strtotime($indexFunc['hasil'][0]['dateCreate'])) ." s/d ". date('d M Y', strtotime($indexFunc['hasil'][26]['dateCreate'])) );
										?>
									</h5>
								</div>
								<div class="card-body py-3">
									<div class="table-responsive">
										<table class="table table-hover my-0 mx-0">
											<thead>
												<tr>
													<th rowspan="2">Responden</th>
													<th class="d-none d-xl-table-cell" colspan="9">Nilai Unsur Pelayanan</th>
												</tr>
											</thead>
											<thead>
												<tr>
												<th></th>
												<?php for($i=1;$i<=count($indexFunc['pertanyaan']);$i++){
														echo '<th class="d-none d-xl-table-cell">Q '.$i.'</th>';
												}?>
												</tr>
											</thead>
											<tbody>
											<?php foreach ($indexFunc['responden'] as $key => $data) { ?>
												<tr>
													<td><?php echo $data['perusahaanResponden'];?></td>
													<?php foreach($indexFunc['hasil'] as $data2){
														if($data2['idResponden']==$data['idResponden']){
														?>
													<td><?php echo $data2['nilaiPertanyaan'];?></td>
													<?php }}?>
												</tr>
												<?php }?>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>

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
<script>
  $( function() {
    $( ".datepicker" ).datepicker();
	$( "#datepicker2" ).datepicker();
  } );
  </script>

</body>

</html>