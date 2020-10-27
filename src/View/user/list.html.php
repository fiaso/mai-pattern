<?php

/** @var \Model\Entity\User[] $userList */
/** @var \Closure $path */
$body = function () use ($userList, $path) {
    echo '<table cellpadding="40" cellspacing="0" border="0">
        <tr><td colspan="4" align="center">Все пользователи</td></tr>';
    echo '<tr>
            <th>id</th>
            <th>Логин</th>
            <th>Имя</th>
            <th>Роль</th>
         </tr>';
    foreach ($userList as $key => $user) {
        echo '<tr><td>' . $user->getId() .
            '</td><td>' . $user->getLogin() .
            '</td><td>' . $user->getName() .
            '</td><td>' . $user->getRole()->getType() .
            '</td></tr>';
    }
    echo '</table>';
};

$renderLayout(
    'main_template.html.php',
    [
        'title' => 'Все пользователи',
        'body' => $body,
    ]
);
