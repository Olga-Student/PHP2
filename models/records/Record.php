<?php

namespace app\models\records;

use app\interfaces\RepositoryInterface;
use app\services\Db;

abstract class Record
{
    public $excludedProperties =
        [
            'db',
            'tableName'
        ];
}