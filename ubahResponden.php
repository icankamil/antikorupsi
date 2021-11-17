<?php 
// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if($_SESSION["loggedin"] === false){
    header("location: admin.php");
    exit;
}
include 'koneksi.php';

//jika berhasil/ada post['id'], jika tidak ada ya tidak dijalankan
if($_POST['id']){
	//membuat variabel id berisi post['id']
	$id = $_POST['id'];
	$ambilData=getIdResponden($id);
	//jika ada datanya
	if($ambilData->num_rows){
		//fetch data ke dalam veriabel $row_view
		$row_view = $ambilData->fetch_assoc();
		//menampilkan data dengan table
		echo '
		<div class="col-12 col-lg-12">
							<div class="card">
								<div class="card-header">
									<h5 class="card-title mb-0">Edit Data</h5>
								</div>
								<form action="" method="post">
								<input type="text" class="form-control mb-3 invisible" placeholder="Nama Pertanyaan" name="idResponden" value="'.$row_view['idResponden'].'">
								<div class="card-body">
									<input type="text" class="form-control mb-3" placeholder="Nama Responden" name="namaResponden" value="'.$row_view['namaResponden'].'" >
									<input type="text" class="form-control mb-3" placeholder="Jabatan Responden" name="profesiResponden" value="'.$row_view['profesiResponden'].'" >
									<input type="text" class="form-control mb-3" placeholder="Jabatan Responden" name="phoneResponden" value="'.$row_view['phoneResponden'].'" >
									<input type="text" class="form-control mb-3" placeholder="Email Responden" name="emailResponden" value="'.$row_view['emailResponden'].'">
									<input type="text" class="form-control mb-3" placeholder="Perusahaan Responden" name="perusahaanResponden" value="'.$row_view['perusahaanResponden'].'" >
								</div>
								<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary" name="edit" value="edit">Simpan</button>
		</form>
							</div>
						</div>';
	}
}

	?>