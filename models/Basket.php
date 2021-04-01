<?php


namespace app\models;


use app\models\records\Product;
use app\models\repositories\ProductRepository;
use app\base\Session;

class Basket
{
    protected $session;
    protected $productRepository;
    /** Получение списка всех товаров в корзине */
    public function getAll()
    {
        $basket = [];
        $productIds = [];
        if ($this->session->setkey('basket')) {
            $productIds = array_filter(
                array_keys($_SESSION['basket']),
                function ($element) {
                    return is_int($element);
                }
            );
        }
        $products = $this->productRepository->getAll($productIds);
            foreach ($products as $product) {
                $basket[] = [
                    'product' => $product,
                    'qty' => $this->session->get['basket'][$product->id],
                ];
            };
        return $basket;
    }

    /** Добавить товар в корзину */
    public function add($productId, $qty)
    {
        $basket = $this->session->get('basket');
        if(isset($basket[$productId])) {
            $basket[$productId] += $qty;
        } else {
            $basket[$productId] = $qty;
        }
    }

    /** Удалить товар из корзины */
    public function remove($productId)
    {
        $basket = $this->session->remove('basket');
        if ($basket[$productId]){
            unset($basket[$productId]);
        }
        $this->session->set('basket', $basket);
    }
}
