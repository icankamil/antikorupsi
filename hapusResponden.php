<?php
// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if($_SESSION["loggedin"] === false){
    header("location: admin.php");
    exit;
}
		include 'koneksi.php';
	
    // Tampilkan semua data
    $ambil = queryResponden();
	
	

//jika berhasil/ada post['id'], jika tidak ada ya tidak dijalankan
if($_POST['id']){
	//membuat variabel id berisi post['id']
	$id = $_POST['id'];
	//query standart select where id
	$view = getIdResponden($id);
	//jika ada datanya
	if($view->num_rows){
		//fetch data ke dalam veriabel $row_view
		$row_view = $view->fetch_assoc();
		//menampilkan data dengan table
		echo '
		<div class="col-12 col-lg-12">
							<div class="card">
								<div class="card-header">
									<h5 class="card-title mb-0">Hapus Data</h5>
								</div>
								<form action="" method="post">
								<h5 class="w-100 text-center">Yakin untuk menghapus data <br><em>'.$row_view['namaResponden'].'?</em></h5>
								<input type="text" class="form-control mb-3 invisible" placeholder="Nama Responden" name="idResponden" value="'.$row_view['idResponden'].'">
								<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-danger" name="hapus">Hapus</button>
		</form>
							</div>
						</div>';
	}
}
?>