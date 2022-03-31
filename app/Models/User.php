<?php

namespace App\Models;

class User extends BaseModel
{
    public function getUser(string $email, string $password): array
    {
        $stmt = 'SELECT * FROM users WHERE email = :email';

        $params = [
            ':email' => $email,
        ];

        $user = $this->database->select($stmt, $params)[0] ?? [];

        if (!$user || !password_verify($password, $user['password'])) {
            /** Incorrect password */
            return [];
        }

        return $user;
    }

    public function createUser(string $email, string $fullName, string $password)
    {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        return $this->database->insert(
            'INSERT into users (`email`, `full_name`, `password`) VALUES (:email, :fullName, :password)',
            [
                ':email' => $email,
                ':fullName' => $fullName,
                ':password' => $hashedPassword,
            ]
        );
    }
}