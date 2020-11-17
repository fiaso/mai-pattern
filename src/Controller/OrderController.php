<?php

declare(strict_types = 1);

namespace Controller;

use Framework\Render;
use Service\Order\Basket;
use Service\User\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class OrderController
{
    use Render;

    /**
     * Корзина
     *
     * @param Request $request
     * @return Response
     */
    public function infoAction(Request $request): Response
    {
        if ($request->isMethod(Request::METHOD_POST)) {
            return $this->redirect('order_checkout');
        }

        $basket = new Basket($request->getSession());
        $productList = $basket->getProductsInfo();
        $price = $basket->calculatePrice();
        $discount = $basket->checkDiscount();
        $isLogged = (new Security($request->getSession()))->isLogged();

        return $this->render('order/info.html.php', [
            'productList' => $productList,
            'price' => $price,
            'discount' => $discount,
            'isLogged' => $isLogged
        ]);
    }

    /**
     * Оформление заказа
     *
     * @param Request $request
     * @return Response
     */
    public function checkoutAction(Request $request): Response
    {
        $isLogged = (new Security($request->getSession()))->isLogged();
        if (!$isLogged) {
            return $this->redirect('user_authentication');
        }

        $price = (new Basket($request->getSession()))->checkout();

        return $this->render('order/checkout.html.php', ['price' => $price]);
    }
}
