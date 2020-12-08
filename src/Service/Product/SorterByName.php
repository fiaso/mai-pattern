<?php


namespace Service\Product;

use Model;
class SorterByName implements ISortableProduct
{
    public function sort(Model\Repository\Product $productList): array
    {
        $sortedProducts = $productList->fetchAll();
        usort($sortedProducts, array($this, "cmp"));

        return $sortedProducts;
    }

    private function cmp(Model\Entity\Product $a, $b)
    {
          if ($a->getName() == $b->getName()) {
              return 0;
          }
          return $a->getName() < $b->getName() ? -1 : 1;
    }
}
