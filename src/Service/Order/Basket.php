<?php

declare(strict_types = 1);

namespace Service\Order;

use Model;
use Service\Billing\Card;
use Service\Communication\Email;
use Service\Discount\UserDiscount;
use Service\Discount\PriceDiscount;
use Service\Discount\ProductDiscount;
use Service\User\Security;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class Basket
{
    /**
     * Сессионный ключ списка всех продуктов корзины
     */
    private const BASKET_DATA_KEY = 'basket';
    private const BASKET_PRICE_KEY = 'price';
    private const BASKET_DISCOUNT_KEY = 'discount';

    /**
     * @var SessionInterface
     */
    private $session;

    /**
     * @param SessionInterface $session
     */
    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    /**
     * Добавляем товар в заказ
     *
     * @param int $product
     *
     * @return void
     */
    public function addProduct(int $product): void
    {
        $basket = $this->session->get(static::BASKET_DATA_KEY, []);
        if (!in_array($product, $basket, true)) {
            $basket[] = $product;
            $this->session->set(static::BASKET_DATA_KEY, $basket);
        }
    }

    /**
     * Проверяем, лежит ли продукт в корзине или нет
     *
     * @param int $productId
     *
     * @return bool
     */
    public function isProductInBasket(int $productId): bool
    {
        return in_array($productId, $this->getProductIds(), true);
    }

    /**
     * Получаем информацию по всем продуктам в корзине
     *
     * @return Model\Entity\Product[]
     */
    public function getProductsInfo(): array
    {
        $productIds = $this->getProductIds();
        return $this->getProductRepository()->search($productIds);
    }

    /**
     * Подсчет итоговой суммы
     *
     * @return float
     */
    public function calculatePrice(): float
    {
        $totalPrice = 0;
        foreach ($this->getProductsInfo() as $product) {
            $totalPrice += $product->getPrice();
        }

        $this->session->set(static::BASKET_PRICE_KEY, $totalPrice);
        return $totalPrice;
    }

    /**
     * Подсчет скидки
     *
     * @return float
     */
    public function checkDiscount(): float
    {
        $security = new Security($this->session);
        $price = $this->session->get(static::BASKET_PRICE_KEY, 0);
        if ($security->getUser() == null || $price == 0) {
            return 0;
        }
        
        $discount = new UserDiscount($security->getUser());

        foreach ($this->getProductsInfo() as $product) {
            $productDiscount = new ProductDiscount($product);
            if ($discount->getDiscount() < $productDiscount->getDiscount()) {
                $discount = $productDiscount;
            }
        }

        $priceDiscount = new PriceDiscount($price);
        if ($discount->getDiscount() < $priceDiscount->getDiscount()) {
            $discount = $priceDiscount;
        }

        $this->session->set(static::BASKET_DISCOUNT_KEY, $discount->getDiscount());
        return $discount->getDiscount();
    }

    /**
     * Оформление заказа
     *
     * @return float
     */
    public function checkout(): float
    {
        // Здесь должна быть некоторая логика выбора способа платежа
        $basketBuilder = new BasketBuilder();
        $basketBuilder->setBilling(new Card());
        // Здесь должна быть некоторая логика получения способа уведомления пользователя о покупке
        $basketBuilder->setCommunication(new Email());
        $basketBuilder->setSecurity(new Security($this->session));

        return $this->checkoutProcess($basketBuilder);
    }

    /**
     * Проведение всех этапов заказа
     *
     * @param BasketBuilder $basketBuilder
     * @return float
     */
    public function checkoutProcess(BasketBuilder $basketBuilder): float {
        $totalPrice = $this->session->get(static::BASKET_PRICE_KEY, 0);
        $discount = $this->session->get(static::BASKET_DISCOUNT_KEY, 0);
        $totalPrice = $totalPrice - $totalPrice / 100 * $discount;

        $basketBuilder->getBilling()->pay($totalPrice);
        
        $user = $basketBuilder->getSecurity()->getUser();

        $basketBuilder->getCommunication()->process($user, 'checkout_template');

        $this->resetBasket();
        return $totalPrice;
    }

    /**
     * Фабричный метод для репозитория Product
     *
     * @return Model\Repository\Product
     */
    protected function getProductRepository(): Model\Repository\Product
    {
        return new Model\Repository\Product();
    }

    /**
     * Получаем список id товаров корзины
     *
     * @return array
     */
    private function getProductIds(): array
    {
        return $this->session->get(static::BASKET_DATA_KEY, []);
    }

    /**
     * Сброс заказа
     *
     *
     * @return void
     */
    public function resetBasket(): void
    {
        $this->session->set(static::BASKET_DATA_KEY, []);
        $this->session->set(static::BASKET_PRICE_KEY, 0);
        $this->session->set(static::BASKET_DISCOUNT_KEY, 0);
    }
}
