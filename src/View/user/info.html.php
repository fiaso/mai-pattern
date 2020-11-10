<?php

/** @var \Model\Entity\User $user */
/** @var \Model\Entity\Order $lastOrder */
/** @var \Closure $path */
$body = function () use ($user, $lastOrder, $path) {
    echo '<table cellpadding="40" cellspacing="0" border="0">
        <tr><td colspan="2" align="center">Личный кабинет</td></tr>
        <tr><td>Логин</td><td>' . $user->getLogin() . '</td></tr>' . 
            '<tr><td>Имя</td><td>' . $user->getName() . '</td></tr>' . 
            '<tr><td>Дата рождения</td><td>' . $user->getBirthday() . '</td></tr>' ; 
    if ($lastOrder != null) {
        echo '<tr><td>Сумма последнего заказа</td><td>' . $lastOrder->getTotalPrice() . '</td></tr>';
    }
    echo '</table>';
};

$renderLayout(
    'main_template.html.php',
    [
        'title' => 'Личный кабинет',
        'body' => $body,
    ]
);
