<?php

use Service\SocialNetwork\ISocialNetwork;

/** @var \Model\Entity\Product $productInfo */
/** @var bool $isInBasket */
/** @var \Closure $path */
$body = function () use ($productInfo, $isInBasket, $path) {
    echo  '
        Супер ' . $productInfo->getName() . ' курс всего за ' . $productInfo->getPrice() . ' руб.
        <br/><br/>
        <form method="post">
            <input name="product" type="hidden" value="' . $productInfo->getId() . '" />';
    if (!$isInBasket) {
        echo '<input type="submit" value="Положить в корзину" />';
    } else {
        echo 'Курс уже находится в корзине.<br/>';
    }
    echo '
        </form>
        <br/>
        <a href="' . $path('product_list') . '">Другие товары</a>
        <a href="' . $path('product_info_all') . '">Описание курсов</a>
        <br />
        <br />
        <a href="' . $path('product_into_social_network', ['network' => ISocialNetwork::SOCIAL_NETWORK_VK]) . '?course=' . $productInfo->getName() . '&page_num=' . $productInfo->getId() . '">Поделиться в VKontakte</a><br />
        <a href="' . $path('product_into_social_network', ['network' => ISocialNetwork::SOCIAL_NETWORK_FACEBOOK]) . '?course=' . $productInfo->getName() . '&page_num=' . $productInfo->getId() . '">Поделиться в Facebook</a><br />
    ';
};

$renderLayout(
    'main_template.html.php',
    [
        'title' => 'Курс ' . $productInfo->getName(),
        'body' => $body,
    ]
);
