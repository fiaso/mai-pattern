<?php

namespace Framework;

class Invoker
{
    public function action(ICommand $command)
    {
        // вызывает другие команды и действия
        return $command->execute();
    }
}