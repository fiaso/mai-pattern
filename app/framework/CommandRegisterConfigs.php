<?php


namespace Framework;


class CommandRegisterConfigs implements ICommand
{
    private $receiver;

    public function __construct(Register $receiver)
    {
        $this->receiver = $receiver;
    }

    public function execute()
    {
        try {
            $result = $this->receiver->registerConfigs();
        } catch (\Throwable $e) {
            $this->redo();
        }
        return $result;
    }

    public function redo()
    {
        die('Cannot read the config file. File: ' . __FILE__ . '. Line: ' . __LINE__);
    }
}