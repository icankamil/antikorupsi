<?php

namespace App\Pertanyaan\Model;

use App\QueryBuilder\Model\QueryBuilder;

class Pertanyaan extends QueryBuilder
{
    protected $table = 'pertanyaan';
    protected $primaryKey = 'idPertanyaan';
}
