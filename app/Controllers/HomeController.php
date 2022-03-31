<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Exceptions\ViewNotFoundException;
use App\Session;
use App\View;

class HomeController
{
    /**
     * @throws ViewNotFoundException
     */
    public function index(): string
    {
        $session = Session::getInstance();
        if (!$session->get('email')) {
            header('Location:' . '/login');
        }

        return View::make('index')->render();
    }
}