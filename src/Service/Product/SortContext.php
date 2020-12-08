<?php


namespace Service\Product;

use Model;
class SortContext
{
    private $strategy;

    public function __construct(string $sortType)
    {
      switch ($sortType) {
        case 'price':
            $this->strategy = new SorterByPrice();
          break;
        case 'name':
            $this->strategy = new SorterByName();
          break;
        default:
          throw new \Exception("Error Processing Request", 1);
          break;
      }
    }

    // можно еще вынести setStrategy в отдельный метод

    public function sort(Model\Repository\Product $productList): array
    {
        return $this->strategy->sort($productList);
    }
}
