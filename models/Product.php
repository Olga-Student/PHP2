<?php

namespace app\models;

class Product extends Model
{
    public $id;
    public $title;
    public $description;
    public $price;


    public function getTableName()
    {
        return 'product_img';
    }
}