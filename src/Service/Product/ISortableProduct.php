<?php

declare(strict_types = 1);

namespace Service\Product;

use Model;

interface ISortableProduct
{
    /**
     * Сортировка
     *
     * @param Model\Repository\Product $productList
     *
     * @return array
     */
    public function sort(Model\Repository\Product $productList): array;
}
