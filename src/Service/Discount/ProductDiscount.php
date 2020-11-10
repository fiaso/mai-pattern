<?php

declare(strict_types = 1);

namespace Service\Discount;

use Model;

class ProductDiscount implements IDiscount
{
    /**
     * @var Model\Entity\Product
     */
    private $product;

    /**
     * @param Model\Entity\Product $product
     */
    public function __construct(Model\Entity\Product $product)
    {
        $this->product = $product;
    }

    /**
     * @inheritdoc
     */
    public function getDiscount(): float
    {
        $discount = 0;
        if ($this->product->getName() == "Delphi") {
            $discount = 8;
        }
        return $discount;
    }
}
