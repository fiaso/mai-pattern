<?php

/** @var float $price */
/** @var \Closure $path */
$body = function () use ($price, $path) {
    ?>
    <form method="post">
        <table cellpadding="10">
            <tr>
                <td colspan="3" align="center">Покупка на сумму <?= $price ?> руб успешно совершена</td>
            </tr>
        </table>
    </form>
    <?php
};

$renderLayout(
    'main_template.html.php',
    [
        'title' => 'Покупка',
        'body' => $body,
    ]
);
