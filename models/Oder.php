<?php


namespace app\models;


class Order extends Model
{
    public $id;
    public $product_id;
    public $title;
    public $user_id;
    public $quantity;
    public $price;


    public function getTableName()
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