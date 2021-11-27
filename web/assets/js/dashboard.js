//ubah produk
$(".ubah-produk").click(function () {
  var id = $(this).attr("data-id");

  // memulai ajax
  $.ajax({
    url: "/admin/pertanyaan/" + id + "/get",
    method: "post",
    success: function (data) {
      // kode dibawah ini jalan kalau sukses
      $("#editModal").find(".namaPertanyaan").val(data.data.namaPertanyaan);
      $("#editModal")
        .find(".jenisPertanyaan-pilihan")
        .prop("checked", data.data.jenisPertanyaan == "pilihan" ? true : false);
      $("#editModal")
        .find(".jenisPertanyaan-essai")
        .prop("checked", data.data.jenisPertanyaan == "essai" ? true : false);
      $("#editModal")
        .find(".formEdit")
        .prop("action", "/admin/pertanyaan/" + id + "/update");
      $("#editModal").modal("show"); // menampilkan dialog modal nya
    },
  });
});

//hapus produk
$(".hapus-produk").click(function () {
  var id = $(this).attr("data-id");

  // memulai ajax
  $("#hapusModal")
    .find(".formHapus")
    .prop("action", "/admin/pertanyaan/" + id + "/delete");
  $("#hapusModal").modal("show");
});

$(document).on("click", ".btnHapus", function () {
  $("#hapusModal").find(".formHapus").submit();
});

// ubah responden
$(".ubah-responden").click(function () {
  var id = $(this).attr("data-id");

  // memulai ajax
  $.ajax({
    url: "/admin/responden/" + id + "/get",
    method: "post",
    success: function (data) {
      // kode dibawah ini jalan kalau sukses
      $("#editModalResponden")
        .find(".namaResponden")
        .val(data.data.namaResponden);
      $("#editModalResponden")
        .find(".profesiResponden")
        .val(data.data.profesiResponden);
      $("#editModalResponden")
        .find(".phoneResponden")
        .val(data.data.phoneResponden);
      $("#editModalResponden")
        .find(".emailResponden")
        .val(data.data.emailResponden);
      $("#editModalResponden")
        .find(".perusahaanResponden")
        .val(data.data.perusahaanResponden);
      $("#editModalResponden")
        .find(".formEdit")
        .prop("action", "/admin/responden/" + id + "/update");
      $("#editModalResponden").modal("show"); // menampilkan dialog modal nya
    },
  });
});

//hapus responden
$(".hapus-responden").click(function () {
  var id = $(this).attr("data-id");

  // memulai ajax
  $("#hapusModalResponden")
    .find(".formHapus")
    .prop("action", "/admin/responden/" + id + "/delete");
  $("#hapusModalResponden").modal("show");
});

$(document).on("click", ".btnHapus", function () {
  $("#hapusModalResponden").find(".formHapus").submit();
});
