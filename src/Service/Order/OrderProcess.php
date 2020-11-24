<?php


namespace Service\Order;


class OrderProcess
{
    private $basketBuilder;

    public function __construct(BasketBuilder $basketBuilder)
    {
        $this->basketBuilder = $basketBuilder;
    }

    /**
     * Проведение всех этапов заказа
     *
     * @return float
     */
    public function checkoutProcess(): float {
        $totalPrice = $this->basketBuilder->getTotalPrice();
        $discount = $this->basketBuilder->getDiscount();
        $totalPrice = $totalPrice - $totalPrice / 100 * $discount;

        $this->basketBuilder->getBilling()->pay($totalPrice);

        $user = $this->basketBuilder->getSecurity()->getUser();

        $this->basketBuilder->getCommunication()->process($user, 'checkout_template');

        return $totalPrice;
    }
}