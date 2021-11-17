<?php
require "global.php";

function indexFunc($tglMulai = '', $tglBerakhir = '') {
    if ($tglMulai != '' && $tglBerakhir == '') {
        $where = "WHERE h.dateCreate = '".date('Y-m-d', strtotime($tglMulai))."'";
    } else {
        $where = $tglMulai != '' ? "WHERE h.dateCreate BETWEEN '".date('Y-m-d', strtotime($tglMulai))."' AND '".date('Y-m-d', strtotime($tglBerakhir))."'" : "";
    }
    $respondenHasil = getData("responden r", "r.idResponden as idResponden, r.namaResponden as namaResponden, r.perusahaanResponden as perusahaanResponden, h.*, p.*", "LEFT JOIN hasil h ON r.idResponden = h.idResponden LEFT JOIN pertanyaan p ON h.idPertanyaan = p.idPertanyaan", $where);
    $responden_uniqe = [];
    foreach ($respondenHasil as $key2 => $value2) {
        array_push($responden_uniqe, $value2['idResponden']);
    };
    $count_responden = count(array_unique($responden_uniqe));

    $responden = getData('responden', '*');
    $pertanyaan = getData("pertanyaan", "*", "", "WHERE jenisPertanyaan = 'pilihan'");

    $hasil = getData("hasil h", "h.*, h.dateCreate as dateCreate", "LEFT JOIN responden r ON r.idResponden = h.idResponden", $where);

    $totalNilai = 0;
    foreach ($responden as $key => $value) {
        $responden[$key]['totalNilai'] = 0;
        foreach ($respondenHasil as $key1 => $value1) {
            if ($value['idResponden'] == $value1['idResponden']) {
                $responden[$key]['totalNilai']+= intval($value1['nilaiPertanyaan']);
            }
        }
        $totalNilai+= $responden[$key]['totalNilai']/count($pertanyaan);
    }
    $totalNilai = ($totalNilai/count($responden));

    $kategori_mutu = '';
    if ($totalNilai <= 2) {
        $kategori_mutu = 'D';
    } else if ($totalNilai >= 2 && $totalNilai < 3) {
        $kategori_mutu = 'C';
    } else if ($totalNilai >= 3 && $totalNilai < 4) {
        $kategori_mutu = 'B';
    } else if ($totalNilai == 4) {
        $kategori_mutu = 'A';
    }

    return ['respondenHasil' => $respondenHasil, 'responden' => $responden, 'totalNilai' => $totalNilai, 'kategori_mutu' => $kategori_mutu, 'hasil' => $hasil, 'pertanyaan' => $pertanyaan, 'count_responden' => $count_responden];
}

?>