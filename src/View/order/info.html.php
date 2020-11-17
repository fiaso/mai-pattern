<?php

/** @var \Model\Entity\Product[] $productList */
/** @var float $price */
/** @var float $discount */
/** @var bool $isLogged */
/** @var \Closure $path */
$body = function () use ($productList, $price, $discount, $isLogged, $path) {
    ?>
    <form method="post">
        <table cellpadding="10">
            <tr>
                <td colspan="3" align="center">Корзина</td>
            </tr>
<?php
    $n = 1;
    foreach ($productList as $product) {
        ?>
            <tr>
                <td><?= $n++ ?>.</td>
                <td><?= $product->getName() ?></td>
                <td><?= $product->getPrice() ?> руб</td>
                <td><input type="button" value="Удалить" /></td>
            </tr>
    <?php
    }
    if ($discount > 0) {
        ?>
            <tr>
                <td colspan="3" align="right">Общая сумма: <?= $price ?> рублей</td>
            </tr>
            <tr>
                <td colspan="3" align="right">Скидка: <?= $discount ?>%</td>
            </tr>
    <?php
        $price = $price * (1 - $discount/100);
    } ?>
            <tr>
                <td colspan="3" align="right">Итого: <?= $price ?> рублей</td>
            </tr>
<?php if ($price > 0) {
        if ($isLogged) {
            ?>
            <tr>
                <td colspan="3" align="center"><input type="submit" value="Оформить заказ" /></td>
            </tr>
<?php
        } else {
            ?>
            <tr>
                <td colspan="4" align="center">Для оформления заказа, <a href="<?= $path('user_authentication') ?>">авторизуйтесь</a></td>
            </tr>
<?php
        }
    } ?>
        </table>
    </form>
<?php
};

$renderLayout(
    'main_template.html.php',
    [
        'title' => 'Корзина',
        'body' => $body,
    ]
);
