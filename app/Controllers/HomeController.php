<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Exceptions\ViewNotFoundException;
use App\View;

class HomeController
{
    /**
     * @throws ViewNotFoundException
     */
    public function index(): string
    {
        return View::make('index')->render();
    }
}