<?php

namespace App\Komentar\Model;

use App\QueryBuilder\Model\QueryBuilder;

class Komentar extends QueryBuilder
{
    protected $table = 'komentar';
    protected $primaryKey = 'idKomentar';
}
