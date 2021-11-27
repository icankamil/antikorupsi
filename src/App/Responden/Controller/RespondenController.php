<?php

namespace App\Responden\Controller;

use App\Hasil\Model\Hasil;
use App\Komentar\Model\Komentar;
use App\Responden\Model\Responden;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

class RespondenController
{
    public $responden;
    public $hasil;
    public $komentar;

    public function __construct()
    {
        $this->responden = new Responden();
        $this->hasil = new Hasil();
        $this->komentar = new Komentar();
    }

    public function index(Request $request)
    {
        return render_template('admin/responden/index', [
            'datas' => $this->responden->paginate(10),
        ]);
    }

    public function get(Request $request)
    {
        $id = $request->attributes->get('id');
        return new JsonResponse(['data' => $this->responden->where('idResponden', $id)->first()]);
    }

    public function update(Request $request)
    {
        $id = $request->attributes->get('id');
        $this->responden->where('idResponden', $id)->update($request->request->all());

        return new RedirectResponse('/admin/responden');
    }

    public function delete(Request $request)
    {
        $id = $request->attributes->get('id');
        $this->responden->where('idResponden', $id)->delete();
        $this->hasil->where('idResponden', $id)->delete();
        $this->komentar->where('idResponden', $id)->delete();

        return new RedirectResponse('/admin/responden');
    }
}
