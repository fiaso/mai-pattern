<?php


namespace Service\Product;


use Model;

class SorterByPrice implements ISortableProduct
{

    /**
     * @inheritDoc
     */
    public function sort(Model\Repository\Product $productList): array
    {
        $sortedProducts = $productList->fetchAll();
        usort($sortedProducts, array($this, "cmp"));

        return $sortedProducts;
    }

    private function cmp(Model\Entity\Product $a, $b)
    {
        if ($a->getPrice() == $b->getPrice()) {
            return 0;
        }
        return $a->getPrice() < $b->getPrice() ? -1 : 1;
    }
}