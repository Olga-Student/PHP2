<?php
class Product {
    public $artikl;
    public $title;
    public $size;
    public $price;
    public $category;
    public $warantlylife;

    //function __construct($artikl, $title, $size, $price, $category, $warantlylife)
    public function addProduct(){

    }
    public function creatProduct(){

    }
    public function delProduct(){

    }

}
class Label extends Product{
    public $strokecod;
}


class A {
    public function foo() {
        static $x = 0;
        echo ++$x;
    }
}
$a1 = new A();
$a2 = new A();
$a1->foo();// при вызове функции присваивается статическое значение переменной х,
// которое сохраняется после окончания работы функции.
// В эхо выводится ее значение увеличенное на единицу, т е 1.


$a2->foo();// ответ 2 не важно сколь объектов метод существует в одном экземпляре
//последующие вызовы дадут увелечение каждый раз на один
$a1->foo();// ответ 3
$a2->foo();// ответ 4

class C {
    public function foo() {
        static $y = 0;
        echo ++$y;
    }
}
class B extends C {
}
$a1 = new C();
$b1 = new B();
$a1->foo();//1  при вызове функции присваивается статическое значение переменной х,
// которое сохраняется после окончания работы функции.
// В эхо выводится ее значение увеличенное на единицу, т е 1.
$b1->foo();//1 при наследовании класса был создан новый метод, который начал выполнение с начала
$a1->foo();//2 при следующем вызове произойдет увеличение на один 1+1
$b1->foo();//2