<?php

declare(strict_types = 1);

namespace Controller;

use Framework\Render;
use Service\Order\History;
use Service\User\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UserController
{
    use Render;

    /**
     * Производим аутентификацию и авторизацию
     *
     * @param Request $request
     * @return Response
     */
    public function authenticationAction(Request $request): Response
    {
        if ($request->isMethod(Request::METHOD_POST)) {
            $user = new Security($request->getSession());

            $isAuthenticationSuccess = $user->authentication(
                $request->request->get('login'),
                $request->request->get('password')
            );

            if ($isAuthenticationSuccess) {
                return $this->render('user/authentication_success.html.php', ['user' => $user->getUser()]);
            } else {
                $error = 'Неправильный логин и/или пароль';
            }
        }

        return $this->render('user/authentication.html.php', ['error' => $error ?? '']);
    }

    /**
     * Получаем информацию о пользователях
     *
     * @param Request $request
     * @return Response
     */
    public function infoAllAction(Request $request): Response
    {
        $userList = (new Security($request->getSession()))->getAll();

        return $this->render('user/list.html.php', ['userList' => $userList]);
    }
    
    /**
     * Получаем информацию о пользователе
     *
     * @param Request $request
     * @return Response
     */
    public function infoAction(Request $request): Response
    {
        $user = (new Security($request->getSession()))->getUser();
        $userOrders = (new History())->getAllByUser($user->getId());
        $lastOrder = null;
        
        if (count($userOrders) > 0) {
            $lastOrder = $userOrders[0];
            
            foreach ($userOrders as $order) {
                if ($order->getOrderDate() > $lastOrder->getOrderDate()) {
                    $lastOrder = $order;
                }
            }
        }
        
        return $this->render('user/info.html.php', ['user' => $user, 'lastOrder' => $lastOrder]);
    }

    /**
     * Выходим из системы
     *
     * @param Request $request
     * @return Response
     */
    public function logoutAction(Request $request): Response
    {
        (new Security($request->getSession()))->logout();

        return $this->redirect('index');
    }
}
