<?php

/** @var \Model\Entity\Product[] $productList */
/** @var \Closure $path */
$body = function () use ($productList, $path) {
    foreach ($productList as $key => $product) {
        echo '<a href="' . $path('product_info', ['id' => $product->getId()]) . '">' . $product->getName() . '</a>
        <br/><br/>
        ' . $product->getDescription() . '
        <br/><br/>';
    }
    echo '
    <br/>
    <a href="' . $path('product_list') . '">Посмотреть цены</a>
    <br />
    <br />
    ';
};

$renderLayout(
    'main_template.html.php',
    [
        'title' => 'Описание курсов',
        'body' => $body,
    ]
);
