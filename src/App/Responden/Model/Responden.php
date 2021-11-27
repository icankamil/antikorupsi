<?php

namespace App\Responden\Model;

use App\QueryBuilder\Model\QueryBuilder;

class Responden extends QueryBuilder
{
    protected $table = 'responden';
    protected $primaryKey = 'idResponden';
}
