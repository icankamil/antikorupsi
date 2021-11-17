//ubah produk
	// yang bawah ini bekerja jika tombol lihat data (class="view_data") di klik
		$('.ubah-produk').click(function(){
			// membuat variabel id, nilainya dari attribut id pada button
			// id="'.$row['id'].'" -> data id dari database ya sob, jadi dinamis nanti id nya
			var id = $(this).attr("id");
			
			// memulai ajax
			$.ajax({
				url: 'ubahPertanyaan.php',	// set url -> ini file yang menyimpan query tampil detail data siswa
				method: 'post',		// method -> metodenya pakai post. Tahu kan post? gak tahu? browsing aja :)
				data: {id:id},		// nah ini datanya -> {id:id} = berarti menyimpan data post id yang nilainya dari = var id = $(this).attr("id");
				success:function(data){		// kode dibawah ini jalan kalau sukses
					$('#dataProduk').html(data);	// mengisi konten dari -> <div class="modal-body" id="data_siswa">
					$('#editModal').modal("show");	// menampilkan dialog modal nya
				}
			});
		});
		
		//hapus produk
	// yang bawah ini bekerja jika tombol lihat data (class="view_data") di klik
		$('.hapus-produk').click(function(){
			// membuat variabel id, nilainya dari attribut id pada button
			// id="'.$row['id'].'" -> data id dari database ya sob, jadi dinamis nanti id nya
			var id = $(this).attr("id");
			
			// memulai ajax
			$.ajax({
				url: 'hapusPertanyaan.php',	// set url -> ini file yang menyimpan query tampil detail data siswa
				method: 'post',		// method -> metodenya pakai post. Tahu kan post? gak tahu? browsing aja :)
				data: {id:id},		// nah ini datanya -> {id:id} = berarti menyimpan data post id yang nilainya dari = var id = $(this).attr("id");
				success:function(data){		// kode dibawah ini jalan kalau sukses
					$('#dataPakan').html(data);	// mengisi konten dari -> <div class="modal-body" id="data_siswa">
					$('#hapusModal').modal("show");	// menampilkan dialog modal nya
				}
			});
		});
		
			//tambah produk
	// yang bawah ini bekerja jika tombol lihat data (class="view_data") di klik
		$('.tambahPertanyaan').click(function(){
			// membuat variabel id, nilainya dari attribut id pada button
			// id="'.$row['id'].'" -> data id dari database ya sob, jadi dinamis nanti id nya
	$('#tambahModal').modal("show");
		});
		
		
		//ubah responden
	// yang bawah ini bekerja jika tombol lihat data (class="view_data") di klik
		$('.ubah-responden').click(function(){
			// membuat variabel id, nilainya dari attribut id pada button
			// id="'.$row['id'].'" -> data id dari database ya sob, jadi dinamis nanti id nya
			var id = $(this).attr("id");
			
			// memulai ajax
			$.ajax({
				url: 'ubahResponden.php',	// set url -> ini file yang menyimpan query tampil detail data siswa
				method: 'post',		// method -> metodenya pakai post. Tahu kan post? gak tahu? browsing aja :)
				data: {id:id},		// nah ini datanya -> {id:id} = berarti menyimpan data post id yang nilainya dari = var id = $(this).attr("id");
				success:function(data){		// kode dibawah ini jalan kalau sukses
					$('#dataResponden').html(data);	// mengisi konten dari -> <div class="modal-body" id="data_siswa">
					$('#editModal').modal("show");	// menampilkan dialog modal nya
				}
			});
		});
		
		//hapus responden
	// yang bawah ini bekerja jika tombol lihat data (class="view_data") di klik
		$('.hapus-responden').click(function(){
			// membuat variabel id, nilainya dari attribut id pada button
			// id="'.$row['id'].'" -> data id dari database ya sob, jadi dinamis nanti id nya
			var id = $(this).attr("id");
			
			// memulai ajax
			$.ajax({
				url: 'hapusResponden.php',	// set url -> ini file yang menyimpan query tampil detail data siswa
				method: 'post',		// method -> metodenya pakai post. Tahu kan post? gak tahu? browsing aja :)
				data: {id:id},		// nah ini datanya -> {id:id} = berarti menyimpan data post id yang nilainya dari = var id = $(this).attr("id");
				success:function(data){		// kode dibawah ini jalan kalau sukses
					$('#dataPakan').html(data);	// mengisi konten dari -> <div class="modal-body" id="data_siswa">
					$('#hapusModal').modal("show");	// menampilkan dialog modal nya
				}
			});
		});
		

