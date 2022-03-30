<?php

declare(strict_types=1);

namespace App\Structures;

class DatabaseConfig
{
    public string $driver;
    public string $host;
    public string $name;
    public string $user;
    public string $password;

    public function __construct()
    {
        $this->driver = $_ENV['DB_DRIVER'] ?? 'mysql';
        $this->host = $_ENV['DB_HOST'] ?? '';
        $this->name = $_ENV['DB_DATABASE'] ?? '';
        $this->user = $_ENV['DB_USER'] ?? '';
        $this->password = $_ENV['DB_PASS'] ?? '';
    }
}