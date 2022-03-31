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
    public function login(): string
    {
        $session = Session::getInstance();
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        $user = new User();

        $userExists = $user->getUser($email, $password);

        if (!$userExists) {
            return View::make('auth/login', [
                'message' => 'User does not exist',
            ])->render();
        }

        $session->set('email', $email);

        return View::make('/', )->render();
    }

    public function logout(): string
    {
        session_destroy();

        return View::make('auth/login')->render();
    }
}