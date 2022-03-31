<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\User;
use App\View;
use App\Session;

class UserController
{
    public function index(): string
    {
        return View::make('auth/login')->render();
    }

    public function login(): void
    {
        $session = Session::getInstance();
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        $user = new User();

        $userExists = $user->getUser($email, $password);

        if (!$userExists) {
            header ('HTTP/1.1 301 Moved Permanently');
            header('Location: /');
        }

        $session->set('email', $email);

        header ('HTTP/1.1 301 Moved Permanently');
        header('Location: /');
    }

    public function logout(): string
    {
        session_destroy();
        header ('HTTP/1.1 301 Moved Permanently');
        header('Location: /');
    }
}