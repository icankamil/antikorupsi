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