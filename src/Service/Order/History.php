<?php

declare(strict_types = 1);

namespace Service\Order;

use Model;

class History{
    
    /**
     * Получаем все заказы пользователя
     *
     * @param int $id
     *
     * @return Model\Entity\Order[]
     */
    public function getAllByUser(int $id): array
    {
        $orderList = $this->getOrderRepository()->searchByUser($id);
        return $orderList;
    }
    
    /**
     * Добавляем заказ
     *
     * @param int $userId
     * @param float $totalPrice
     */
    public function addOrder(int $userId, float $totalPrice)
    {
        $this->getOrderRepository()->addNew($userId, $totalPrice);
    }
    
    
    /**
     * Фабричный метод для репозитория Order
     *
     * @return Model\Repository\Order
     */
    protected function getOrderRepository(): Model\Repository\Order
    {
        return new Model\Repository\Order();
    }
}

