<?php


namespace Framework;


class CommandSetContainerBuilder implements ICommand
{
    private $receiver;

    public function __construct(Register $receiver)
    {
        $this->receiver = $receiver;
    }

    public function execute()
    {
        return $this->receiver->setContainerBuilder();
    }
}