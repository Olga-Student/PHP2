<?php

namespace app\models\records;


class Category extends Records
{
    public $id;
    public $name;

    public static function getTableName()
    {
        return 'categories';
    }
}