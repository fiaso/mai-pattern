<?php


namespace Service\SocialNetwork;


class VKAdapter implements ISocialNetwork
{
    private $vkontakte;

    public function __construct(VKontakte $vk)
    {
        $this->vkontakte = $vk;
    }

    public function send(string $message): void
    {
        $this->vkontakte->post($message);
    }
}