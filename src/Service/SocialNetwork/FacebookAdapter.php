<?php


namespace Service\SocialNetwork;


class FacebookAdapter implements ISocialNetwork
{
    private $facebook;

    public function __construct(Facebook $fb)
    {
        $this->facebook = $fb;
    }

    public function send(string $message): void
    {
        $this->facebook->post($message);
    }
}