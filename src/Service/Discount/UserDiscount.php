<?php

declare(strict_types = 1);

namespace Service\Discount;

use Model;

class UserDiscount implements IDiscount
{
    /**
     * @var Model\Entity\User
     */
    private $user;

    /**
     * @param Model\Entity\User $user
     */
    public function __construct(Model\Entity\User $user)
    {
        $this->user = $user;
    }

    /**
     * @inheritdoc
     */
    public function getDiscount(): float
    {
        $discount = 0;
        $birthday= strtotime($this->user->getBirthday());
        $nowyear="." . date("Y", time());
        $startdate = date("d.m", strtotime("-5 days", $birthday)) . $nowyear;
        $enddate = date("d.m", strtotime("+6 days", $birthday)) . $nowyear;
        $now=time();

        if (($now >= strtotime($startdate)) && ($now < strtotime($enddate))) {
            $discount = 5;
        }

        return $discount;
    }
}
