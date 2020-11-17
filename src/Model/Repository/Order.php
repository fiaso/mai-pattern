<?php

declare(strict_types = 1);

namespace Model\Repository;

use Model\Entity;

class Order
{
    /**
     * @var array
     */
    private $dataSource = [
        [
            'id' => 1,
            'userId' => 1,
            'totalPrice' => 45700,
            'orderDate' => 1605030161,
        ],
        [
            'id' => 2,
            'userId' => 1,
            'totalPrice' => 30100,
            'orderDate' => 1600000000,
        ],
        [
            'id' => 3,
            'userId' => 5,
            'totalPrice' => 20400,
            'orderDate' => 1585908121,
        ],
        [
            'id' => 4,
            'userId' => 5,
            'totalPrice' => 30600,
            'orderDate' => 1500000000,
        ],
        [
            'id' => 5,
            'userId' => 2,
            'totalPrice' => 18600,
            'orderDate' => 1285908121,
        ],
        [
            'id' => 8,
            'userId' => 2,
            'totalPrice' => 8400,
            'orderDate' => 1200000000,
        ],
    ];
    
    
    /**
     * Поиск заказов по id пользователя
     *
     * @param int $id
     * @return Entity\Order[]
     */
    public function searchByUser(int $id): array
    {
        $orderList = [];
        foreach ($this->dataSource as $item) {
            if ($item['userId'] == $id) {
                $orderList[] = new Entity\Order($item['id'], $item['userId'], $item['totalPrice'], $item['orderDate']);
            }
        }

        return $orderList;
    }

    /**
     * Получаем все заказы
     *
     * @return Entity\Order[]
     */
    public function getAll(): array
    {
        $orderList = [];
        foreach ($this->dataSource as $item) {
            $orderList[] = new Entity\Order($item['id'], $item['userId'], $item['totalPrice'], $item['orderDate']);
        }

        return $orderList;
    }
    
    /**
     * Добавляем заказ
     *
     * @param int $userId
     * @param float $totalPrice
     */
    public function addNew(int $userId, float $totalPrice)
    {
        $order = [
            'id' => count($this->dataSource),
            'userId' => $userId,
            'totalPrice' => $totalPrice,
            'orderDate' => time(),
        ];
        array_push($this->dataSource, $order);
    }
}
