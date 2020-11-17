<?php

declare(strict_types = 1);

namespace Service\Order;


use Service\Billing\IBilling;
use Service\Communication\ICommunication;
use Service\User\ISecurity;

class BasketBuilder
{
    private $billing;
    private $security;
    private $communication;

    /**
     * @param IBilling $billing
     * @return void
     */
    public function setBilling(IBilling $billing): void
    {
        $this->billing = $billing;
    }

    /**
     * @return IBilling
     */
    public function getBilling(): IBilling
    {
        return $this->billing;
    }

    /**
     * @param ISecurity $security
     * @return void
     */
    public function setSecurity(ISecurity $security): void
    {
        $this->security = $security;
    }

    /**
     * @return ISecurity
     */
    public function getSecurity(): ISecurity
    {
        return $this->security;
    }

    /**
     * @param ICommunication $communication
     * @return void
     */
    public function setCommunication(ICommunication $communication): void
    {
        $this->communication = $communication;
    }

    /**
     * @return ICommunication
     */
    public function getCommunication(): ICommunication
    {
        return $this->communication;
    }
}