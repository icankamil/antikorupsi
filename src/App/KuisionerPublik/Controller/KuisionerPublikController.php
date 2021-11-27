<?php

namespace App\KuisionerPublik\Controller;

use App\Hasil\Model\Hasil;
use App\Komentar\Model\Komentar;
use App\Pertanyaan\Model\Pertanyaan;
use App\Responden\Model\Responden;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

class KuisionerPublikController
{
    public $pertanyaan;
    public $responden;
    public $hasil;
    public $komentar;

    public function __construct()
    {
        $this->pertanyaan = new Pertanyaan;
        $this->responden = new Responden;
        $this->hasil = new Hasil;
        $this->komentar = new Komentar;
    }

    public function index(Request $request)
    {
        $pertanyaan = $this->pertanyaan->get();

        return render_template('public/kuisioner-publik/index', ['pertanyaan' => $pertanyaan]);
    }

    public function send(Request $request)
    {
        $datas = $request->request->all();
        $namaResponden = $datas['q1'];
        $emailResponden = $datas['q2'];
        $phoneResponden = $datas['q3'];
        $perusahaanResponden = $datas['q4'];
        $jabatanResponden = $datas['q5'];
        $idSession = uniqid('sesi');
        $idResponden = uniqid('resp');

        $this->responden->insert([
            'idResponden' => $idResponden,
            'namaResponden' => $namaResponden,
            'profesiResponden' => $jabatanResponden,
            'phoneResponden' => $phoneResponden,
            'emailResponden' => $emailResponden,
            'perusahaanResponden' => $perusahaanResponden,
            'dateCreate' =>  date("Y-m-d"),
        ]);

        $pertanyaan = $this->pertanyaan->get();
        foreach ($pertanyaan->items as $value) {
            $idPertanyaan = $value['idPertanyaan'];
            if ($value['jenisPertanyaan'] == 'pilihan') {
                $quiz = $datas['a' . $value['idPertanyaan']];
                $this->hasil->insert([
                    'idSession' => $idSession,
                    'nilaiPertanyaan' => $quiz,
                    'dateCreate' => date("Y-m-d"),
                    'idResponden' => $idResponden,
                    'idPertanyaan' => $idPertanyaan,
                ]);
            } else {
                $quiz = $datas['b' . $value['idPertanyaan']];
                $this->komentar->insert([
                    'idKomentar' => uniqid('koment'),
                    'isiKomentar' => $quiz,
                    'dateCreate' => date("Y-m-d"),
                    'idSession' => $idSession,
                    'idResponden' => $idResponden,
                    'idPertanyaan' => $idPertanyaan,
                ]);
            }
        }

        return new RedirectResponse('/');
    }
}
