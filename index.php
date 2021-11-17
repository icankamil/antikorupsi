<?php
include 'koneksi.php';
$sesi=uniqid('sesi');
$responden=uniqid('resp');
$komentar=uniqid('koment');

$dataJumlah= queryData();

//tambah data produk
	if (isset($_POST['jawab'])) {
		$idSession = $sesi;
		$idResponden = $responden;
		$idKomentar = $komentar;
		$namaResponden = $_POST['q1'];
		$emailResponden = $_POST['q2'];
		$phoneResponden = $_POST['q3'];
		$perusahaanResponden = $_POST['q4'];
		$jabatanResponden = $_POST['q5'];
		$dateCreate = date("Y-m-d");

		$q = $conn->query("INSERT INTO responden VALUES ('$idResponden', '$namaResponden', '$jabatanResponden', '$phoneResponden', '$emailResponden', '$perusahaanResponden', '$dateCreate')");

		foreach ($dataJumlah as $value) {
			$idPertanyaan = $value['idPertanyaan'];
			if ($value['jenisPertanyaan'] == 'pilihan') {
				$quiz = $_POST['a'.$value['idPertanyaan']];
				$q = $conn->query("INSERT INTO hasil VALUES ('$idSession', '$quiz', '$dateCreate', '$idResponden', '$idPertanyaan')");
			} else {
				$quiz = $_POST['b'.$value['idPertanyaan']];
				$q = $conn->query("INSERT INTO komentar VALUES ('$idKomentar', '$quiz', '$dateCreate', '$idSession', '$idResponden', '$idPertanyaan')");
			}
		}
		if ($q) {
		// pesan jika data tersimpan
		echo "<script>alert('Data berhasil ditambahkan, Terima Kasih'); window.location.href='/antikorupsi';</script>";
		} else {
		// pesan jika data gagal disimpan
		echo "<script>alert('Data gagal ditambahkan, mohon coba kembali');window.location.href='/antikorupsi';</script>";
		}
}

?>
<!DOCTYPE html>
<html lang="en" class="no-js">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge"> 
		<meta name="viewport" content="width=device-width, initial-scale=1"> 
		<title>Form Persepsi Anti Korupsi</title>
		<meta name="description" content="Form Persepsi Anti Korupsi" />
		<meta name="keywords" content="balai besar keramik, kementrian perindustrian" />
		<meta name="author" content="ican" />
		<link rel="shortcut icon" href="../favicon.ico">
		<link rel="stylesheet" type="text/css" href="css/normalize.css" />
		<link rel="stylesheet" type="text/css" href="css/demo.css" />
		<link rel="stylesheet" type="text/css" href="css/component.css" />
		<link rel="stylesheet" type="text/css" href="css/cs-select.css" />
		<link rel="stylesheet" type="text/css" href="css/cs-skin-boxes.css" />
		<script src="js/modernizr.custom.js"></script>
	</head>
<body>
		<div class="container">

			<div class="fs-form-wrap" id="fs-form-wrap">
				<div class="fs-title">
					<h1>Form Persepsi Anti Korupsi</h1>
					<div class="codrops-top">
						<img src="img/logokemenperin-07.png" style="width:22vh;">
					</div>
				</div>
				<form id="myform" class="fs-form fs-form-full" autocomplete="off" method="post" action="">
					<ol class="fs-fields">
						<li>
							<label class="fs-field-label fs-anim-upper" for="q1">Nama Anda?</label>
							<input class="fs-anim-lower" id="q1" name="q1" type="text" placeholder="Nama Lengkap" required/>
						</li>
						<li>
							<label class="fs-field-label fs-anim-upper" for="q2" data-info="We won't send you spam, we promise...">Punya email?</label>
							<input class="fs-anim-lower" id="q2" name="q2" type="email" placeholder="akunanda@email.us" required/>
						</li>
						<li>
							<label class="fs-field-label fs-anim-upper" for="q3" data-info="We won't send you spam, we promise...">Kontak aktif</label>
							<input class="fs-anim-lower" id="q3" name="q3" type="text" placeholder="Nomor Handphone" required/>
						</li>
						<li>
							<label class="fs-field-label fs-anim-upper" for="q4">Perusahaan</label>
							<input class="fs-anim-lower" id="q4" name="q4" type="text" placeholder="Nama Perusahaan" required/>
						</li>
						<li>
							<label class="fs-field-label fs-anim-upper" for="q5">Jabatan</label>
							<input class="fs-anim-lower" id="q5" name="q5" type="text" placeholder="Jabatan" required/>
						</li>
						<?php 
						$index = 5;
						while($row=mysqli_fetch_array($dataJumlah)){ 
						$index+=1;
						if($row['jenisPertanyaan'] == "pilihan"){
						echo'<li data-input-trigger>
							<label class="fs-field-label fs-anim-upper" for="q'.$index.'" data-info="Sesuai Form Persepsi KEMENPERIN">'.$row['namaPertanyaan'].'</label>
							<div class="fs-radio-group fs-radio-custom clearfix fs-anim-lower">
								<span><input id="q'.$index.'b" name="a'.$row['idPertanyaan'].'" type="radio" value="1"/><label for="q'.$index.'b" class="radio-conversion">Tidak Setuju</label></span>
								<span><input id="q'.$index.'c" name="a'.$row['idPertanyaan'].'" type="radio" value="2"/><label for="q'.$index.'c" class="radio-social">Kurang Setuju</label></span>
								<span><input id="q'.$index.'a" name="a'.$row['idPertanyaan'].'" type="radio" value="3"/><label for="q'.$index.'a" class="radio-mobile">Setuju</label></span>
								<span><input id="q'.$index.'d" name="a'.$row['idPertanyaan'].'" type="radio" value="4"/><label for="q'.$index.'d" class="radio-diversion">Sangat Setuju</label></span>
							</div>
						</li>';
						 } else {
							 echo'<li>
							<label class="fs-field-label fs-anim-upper" for="b'.$row['idPertanyaan'].'">'.$row['namaPertanyaan'].'</label>
							<textarea class="fs-anim-lower" id="b'.$row['idPertanyaan'].'" name="b'.$row['idPertanyaan'].'" placeholder="Silakan isi"></textarea>
						</li>';
						 
						}}?>
					</ol><!-- /fs-fields -->
					<button class="fs-submit" type="submit" name="jawab">Send answers</button>
				</form><!-- /fs-form -->
			</div><!-- /fs-form-wrap -->

			<!-- Related demos -->
			<div class="related">
				<p>This system build by :</p>
				<img src="img/asta-02.png">
			</div>

		</div><!-- /container -->
		<script src="js/classie.js"></script>
		<script src="js/selectFx.js"></script>
		<script src="js/fullscreenForm.js"></script>
		<script>
			(function() {
				var formWrap = document.getElementById( 'fs-form-wrap' );

				[].slice.call( document.querySelectorAll( 'select.cs-select' ) ).forEach( function(el) {	
					new SelectFx( el, {
						stickyPlaceholder: false,
						onChange: function(val){
							document.querySelector('span.cs-placeholder').style.backgroundColor = val;
						}
					});
				} );

				new FForm( formWrap, {
					onReview : function() {
						classie.add( document.body, 'overview' ); // for demo purposes only
					}
				} );
			})();
		</script>
	</body>
</html>