<?php


namespace Service\Order;


use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Service\Billing\Card;
use Service\Communication\Email;
use Service\User\Security;

class OrderFacade
{
    private $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    /**
     * Оформление заказа
     *
     * @param float $totalPrice
     * @param float $discount
     * @return float
     */
    public function checkout(float $totalPrice, $discount): float
    {
        $basketBuilder = new BasketBuilder();
        // Здесь должна быть некоторая логика выбора способа платежа
        $basketBuilder->setBilling(new Card());
        // Здесь должна быть некоторая логика получения способа уведомления пользователя о покупке
        $basketBuilder->setCommunication(new Email());
        $basketBuilder->setSecurity(new Security($this->session));
        $basketBuilder->setTotalPrice($totalPrice);
        $basketBuilder->setDiscount($discount);

        return (new OrderProcess($basketBuilder))->checkoutProcess();
    }
}