<?php 

namespace Core;

use App\QueryBuilder\Model\QueryBuilder;

class Model extends QueryBuilder
{
    private $mustHaveProperty = [
        'table',
        'primaryKey',
    ];

    public function __get($property)
    {
        foreach ($this->mustHaveProperty as $key => $value) {
            if (!isset($this->$value)) {
                echo 'Exception: Property <b>' . $value . '</b> must be defined in class <b>' . get_class($this) . '</b>';
                die();
            }
        }

        return $this->$property;
    }
}
