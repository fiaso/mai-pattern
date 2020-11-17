<?php

declare(strict_types = 1);

namespace Model\Entity;

class Order
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var int
     */
    private $userId;

    /**
     * @var float
     */
    private $totalPrice;
    
    /**
    * @var int
    */
    private $orderDate;

    /**
     * @param int $id
     * @param int $userId
     * @param float $totalPrice
     * @param int $orderDate
     */
    public function __construct(int $id, int $userId, float $totalPrice, int $orderDate)
    {
        $this->id = $id;
        $this->userId = $userId;
        $this->totalPrice = $totalPrice;
        $this->orderDate = $orderDate;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * @return float
     */
    public function getTotalPrice(): float
    {
        return $this->totalPrice;
    }

    /**
     * @return int
     */
    public function getOrderDate(): int
    {
        return $this->orderDate;
    }
}
