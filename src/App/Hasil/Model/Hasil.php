<?php

namespace App\Hasil\Model;

use App\QueryBuilder\Model\QueryBuilder;

class Hasil extends QueryBuilder
{
    protected $table = 'hasil';
    protected $primaryKey = 'idSession';
}
