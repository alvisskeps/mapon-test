<?php

namespace App\Models;

use App\Database;
use App\Structures\DatabaseConfig;

class BaseModel
{
    protected Database $database;

    public function __construct()
    {
        $dbConfig = new DatabaseConfig();

        $this->database = new Database($dbConfig);
    }
}