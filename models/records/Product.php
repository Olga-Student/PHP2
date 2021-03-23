<?php

namespace app\models\records;



class Product extends Records
{
    public $id;
    public $title;
    public $description;
    public $price;


    public static function getTableName()
    {
        return 'products';
    }
}