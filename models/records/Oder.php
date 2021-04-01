<?php


namespace app\models\records;


class Order extends Record
{
    public $id;
    public $product_id;
    public $title;
    public $user_id;
    public $quantity;
    public $price;


    public static function getTableName()
    {
        return 'orders';
    }

    public function addProducts($id){

    }

    public function addAddressOrder(){

    }

    public function addMetodPay(){

    }
}