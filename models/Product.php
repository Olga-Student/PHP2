<?php
namespace app\models;


use app\services\Db;

class Product extends Model
{
    public $id;
    public $title;
    public $description;
    public $price;
    public $categoryId;



    public function getByCategoryId(int $id)
    {

    }
    public function getTableName()
    {
        return 'product_img';
    }
}