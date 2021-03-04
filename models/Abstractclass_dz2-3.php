<?php
/*
1. Создать структуру классов ведения товарной номенклатуры.
а) Есть абстрактный товар.
б) Есть цифровой товар, штучный физический товар и товар на вес.
в) У каждого есть метод подсчета финальной стоимости.
г) У цифрового товара стоимость постоянная – дешевле штучного товара в два раза. У штучного товара обычная стоимость, у весового – в зависимости от продаваемого количества в килограммах. У всех формируется в конечном итоге доход с продаж.
д) Что можно вынести в абстрактный класс, наследование?
*/

abstract class Goods {

    public $id;
    public $name;
    public $price;
    public $category;


    public function __construct($id, $name, $price, $category) {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->category = $category;
    }

    public function getCategory() {
        return $this->category;
    }

    public function setCategory($category) {
        $this->category = $category;
    }

    abstract protected function getPrice();
    abstract protected function getTotalPrice();
    abstract protected function getInfo();


}
class Weightgoods extends Goods {

    public $category;
    public $id;
    public $name;
    public $price;
    public $characterquantity;
    public $quantity;

    function __construct($category, $id, $name, $price, $characterquantity, $quantity) {
        parent::__construct($id, $name, $price, $category);
        $this->characterquantity = $characterquantity;
        $this->quantity = $quantity;
    }

    function getPrice() {
        return $this->price;
    }
    function getTotalPrice(){
        return $totalPrice = ( $this->price * $this->quantity );
    }

    function getInfo() {
        $info  = "кат. {$this->category}; ";
        $info .= "арт. {$this->id}; ";
        $info .= "наим. {$this->name}; ";
        $info .= "цена {$this->getTotalPrice()} руб.; ";
        $info .= "за 1  {$this->characterquantity} ; ";
        $info .= "</br>";
        return $info;
    }
}
class Piecegoods extends Goods
{

    public $id;
    public $name;
    public $price;
    public $category;
    public $discaunt;

    function __construct($category, $id, $name, $price, $discaunt)
    {
        parent::__construct($id, $name, $price, $category);

        $this->discaunt = $discaunt;

    }

    function getPrice()
    {
        return $this->price;
    }

    function getTotalPrice()
    {
        return $totalPrice = ($this->price - $this->price * $this->discaunt);
    }

    function getInfo()
    {
        $info = "кат. {$this->category}; ";
        $info .= "арт. {$this->id}; ";
        $info .= "наим. {$this->name}; ";
        $info .= "цена {$this->price} руб.; ";
        $info .= "скидка  {$this->discaunt} руб. ; ";
        $info .= "</br>";
        return $info;
    }
}
class Readgoods extends Piecegoods
{

    public $id;
    public $name;
    public $author;
    public $price;
    public $category;
    public $quantitybyte;
    public $discaunt;

    function __construct($category, $id, $name, $price, $discaunt, $author, $quantitypage )
    {
        parent::__construct($id, $name, $price, $category, $discaunt);

        $this->author = $author;
        $this->quantitypage =$quantitypage;


    }
    function getPrice() {
        return $this->price;
    }

    function getTotalPrice()
    {
        return $totalPrice = ($this->price - $this->price * $this->discaunt)/2;
    }
    function getInfo()
    {
       $info = "Автор: . {$this->author}" . "название: . {$this->name}, " .
           "электронная книга займет: . {$this->quantitybyte}, " .
            "стоимость  {$this->getTotalPrice()} руб.; ";
       return $info;
    }
}

