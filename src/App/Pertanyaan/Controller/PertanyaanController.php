<?php

namespace App\Pertanyaan\Controller;

use App\Pertanyaan\Model\Pertanyaan;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

class PertanyaanController
{
    public $pertanyaan;

    public function __construct()
    {
        $this->pertanyaan = new Pertanyaan();
    }

    public function index(Request $request)
    {
        return render_template('admin/pertanyaan/index', [
            'datas' => $this->pertanyaan->paginate(10),
        ]);
    }

    public function store(Request $request)
    {
        $request->request->set('dateCreate', date('Y-m-d'));
        $this->pertanyaan->insert($request->request->all());

        return new RedirectResponse('/admin/pertanyaan');
    }

    public function get(Request $request)
    {
        $id = $request->attributes->get('id');
        return new JsonResponse(['data' => $this->pertanyaan->where('idPertanyaan', $id)->first()]);
    }

    public function update(Request $request)
    {
        $id = $request->attributes->get('id');
        $this->pertanyaan->where('idPertanyaan', $id)->update($request->request->all());

        return new RedirectResponse('/admin/pertanyaan');
    }

    public function delete(Request $request)
    {
        $id = $request->attributes->get('id');
        $this->pertanyaan->where('idPertanyaan', $id)->delete();

        return new RedirectResponse('/admin/pertanyaan');
    }
}
