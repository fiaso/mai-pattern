<?php

declare(strict_types = 1);

namespace Service\User;

use Model;

interface ISecurity
{
    /**
     * Получаем сущность пользователя по сессии
     *
     * @return Model\Entity\User|null
     */
    public function getUser(): ?Model\Entity\User;

    /**
     * Получаем роль пользователя по сессии
     *
     * @return Model\Entity\Role|null
     */
    public function getRole(): ?Model\Entity\Role;

    /**
     * Проверяет, является ли пользователь авторизованным
     *
     * @return bool
     */
    public function isLogged(): bool;

    /**
     * Проверяет, является ли пользователь админом
     *
     * @return bool
     */
    public function isAdmin(): bool;


    /**
     * Производим операцию аутентификации
     *
     * @param string $login
     * @param string $password
     * @return bool
     */
    public function authentication(string $login, string $password): bool;

    /**
     * Выход из системы
     *
     * @return void
     */
    public function logout(): void;
}
