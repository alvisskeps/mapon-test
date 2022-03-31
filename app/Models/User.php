<?php

namespace App\Models;

class User extends BaseModel
{
    public function getUser(string $email, string $password): array
    {
        $stmt = 'SELECT * FROM users WHERE email = :email and password = :password';

        $params = [
            ':email' => $email,
            ':password' => $password,
        ];

        return $this->database->select($stmt, $params);
    }
}