<?php

declare(strict_types = 1);

namespace Service\Discount;

class PriceDiscount implements IDiscount
{
    /**
     * @var float 
     */
    private $price;

    /**
     * @param float $price
     */
    public function __construct(float $price)
    {
        $this->price = $price;
    }

    /**
     * @inheritdoc
     */
    public function getDiscount(): float
    {
        $discount = 0;

        if ($this->price > 40000) {
          $discount = 10;
        }

        return $discount;
    }
}
