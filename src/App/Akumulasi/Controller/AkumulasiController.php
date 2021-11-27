<?php

namespace App\Akumulasi\Controller;

use App\Hasil\Model\Hasil;
use App\Pertanyaan\Model\Pertanyaan;
use App\Responden\Model\Responden;
use Symfony\Component\HttpFoundation\Request;

class AkumulasiController
{
    public $responden;
    public $pertanyaan;
    public $hasil;

    public function __construct()
    {
        $this->responden = new Responden();
        $this->pertanyaan = new Pertanyaan();
        $this->hasil = new Hasil();
    }

    public function index(Request $request)
    {
        $tgl_mulai = $request->query->get('tgl_mulai');
        $tgl_berakhir = $request->query->get('tgl_berakhir');

        $respondenHasil = $this->responden->alias('r')
            ->select('r.idResponden', 'r.namaResponden', 'r.perusahaanResponden', 'h.*', 'p.*')
            ->leftJoin('hasil h', 'r.idResponden', '=', 'h.idResponden')
            ->leftJoin('pertanyaan p', 'h.idPertanyaan', '=', 'p.idPertanyaan')
            ->where(function ($query) use ($tgl_mulai, $tgl_berakhir) {
                if ($tgl_mulai != null && $tgl_berakhir == null) {
                    $query->where('h.dateCreate', date('Y-m-d', strtotime($tgl_mulai)));
                } else if ($tgl_mulai != null && $tgl_berakhir != null) {
                    $query->whereBetween('h.dateCreate', [date('Y-m-d', strtotime($tgl_mulai)), date('Y-m-d', strtotime($tgl_berakhir))]);
                }
            })->get();

        $responden_uniqe = [];
        foreach ($respondenHasil->items as $key2 => $value2) {
            array_push($responden_uniqe, $value2['idResponden']);
        };
        $count_responden = count(array_unique($responden_uniqe));

        $responden = $this->responden->get();
        $pertanyaan = $this->pertanyaan->where('jenisPertanyaan', 'pilihan')->get();

        $hasil = $this->hasil->alias('h')
            ->select('h.*', 'h.dateCreate as dateCreate')
            ->leftJoin('responden r', 'h.idResponden', '=', 'r.idResponden')
            ->where(function ($query) use ($tgl_mulai, $tgl_berakhir) {
                if ($tgl_mulai != '' && $tgl_berakhir == '') {
                    $query->where('h.dateCreate', date('Y-m-d', strtotime($tgl_mulai)));
                } else if ($tgl_mulai != null && $tgl_berakhir != null) {
                    $query->whereBetween('h.dateCreate', [date('Y-m-d', strtotime($tgl_mulai)), date('Y-m-d', strtotime($tgl_berakhir))]);
                }
            })->get();

        $totalNilai = 0;
        foreach ($responden->items as $key => $value) {
            $responden->items[$key]['totalNilai'] = 0;
            foreach ($respondenHasil->items as $key1 => $value1) {
                if ($value['idResponden'] == $value1['idResponden']) {
                    $responden->items[$key]['totalNilai'] += intval($value1['nilaiPertanyaan']);
                }
            }
            $totalNilai += $responden->items[$key]['totalNilai'] / count($pertanyaan->items);
        }
        $totalNilai = ($totalNilai / count($responden->items));

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

        return render_template('admin/akumulasi/index', compact('respondenHasil', 'responden', 'totalNilai', 'kategori_mutu', 'hasil', 'pertanyaan', 'count_responden'));
    }

    public function detail(Request $request)
    {
        $tgl_mulai = $request->query->get('tgl_mulai');
        $tgl_berakhir = $request->query->get('tgl_berakhir');

        $pertanyaan = $this->pertanyaan->where('jenisPertanyaan', 'pilihan')->get();

        $respondenHasil = $this->responden->alias('r')
            ->select('r.idResponden as idResponden', 'h.*', 'p.*')
            ->leftJoin('hasil h', 'r.idResponden', '=', 'h.idResponden')
            ->leftJoin('pertanyaan p', 'h.idPertanyaan', '=', 'p.idPertanyaan')
            ->where(function ($query) use ($tgl_mulai, $tgl_berakhir) {
                if ($tgl_mulai != null && $tgl_berakhir == null) {
                    $query->where('h.dateCreate', date('Y-m-d', strtotime($tgl_mulai)));
                } else if ($tgl_mulai != null && $tgl_berakhir != null) {
                    $query->whereBetween('h.dateCreate', [date('Y-m-d', strtotime($tgl_mulai)), date('Y-m-d', strtotime($tgl_berakhir))]);
                }
            })->get();

        $responden = $this->responden->get();
        $hasil = $this->hasil->get();

        $getTotalNilai = function ($totalNilaiResponden, $id) {
            $total = 0;
            foreach ($totalNilaiResponden as $key => $value) {
                if ($value['idResponden'] == $id) {
                    $total += intval($value['nilaiPertanyaan']);
                }
            }

            return $total;
        };

        return render_template('admin/akumulasi/detail', compact('respondenHasil', 'responden', 'hasil', 'pertanyaan', 'getTotalNilai'));
    }
}
