<?php


namespace app\models\repositories;


use app\models\records\Product;

class ProductRepository extends Repository
{
    public function getTableName()
    {
        return 'products';
    }

    public function getRecordClass()
    {
        return Product::class;
    }

}
