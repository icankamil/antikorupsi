<?php
require "global.php";

function indexFunc($tglMulai = '', $tglBerakhir = '')  {
    $pertanyaan = getData("pertanyaan", "*", "WHERE jenisPertanyaan = 'pilihan'");
    if ($tglMulai != '' && $tglBerakhir == '') {
        $where = "WHERE h.dateCreate = '".date('Y-m-d', strtotime($tglMulai))."'";
    } else {
        $where = $tglMulai != '' ? "WHERE h.dateCreate BETWEEN '".date('Y-m-d', strtotime($tglMulai))."' AND '".date('Y-m-d', strtotime($tglBerakhir))."'" : "";
    }
    $respondenHasil = getData("responden r", "r.idResponden as idResponden, h.*, p.*", "LEFT JOIN hasil h ON r.idResponden = h.idResponden LEFT JOIN pertanyaan p ON h.idPertanyaan = p.idPertanyaan", $where);
    $responden = getData('responden', '*');
    $hasil = getData('hasil', '*');

    return ['pertanyaan' => $pertanyaan, 'responden' => $responden, 'hasil' => $hasil, 'total', 'respondenHasil' => $respondenHasil];
}

function getTotalNilai($totalNilaiResponden, $id) {
    $total = 0;
    foreach ($totalNilaiResponden as $key => $value) {
        if ($value['idResponden'] == $id) {
            $total+= intval($value['nilaiPertanyaan']);
        }
    }

    return $total;
};

?>