<?php

declare(strict_types=1);

namespace App;

use App\Structures\DatabaseConfig;
use PDO;
use PDOException;
use PDOStatement;

class Database
{
    public PDO $connection;

    public function __construct(DatabaseConfig $config)
    {
        $dsn = $config->driver . ':host=' . $config->host . ';dbname=' . $config->name;

        try {
            $this->connection = new PDO(
                $dsn,
                $config->user,
                $config->password
            );
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    public function insert(string $statement = '', array $parameters = []): int
    {
        $this->executeStatement($statement, $parameters);

        return (int)$this->connection->lastInsertId();
    }

    public function select(string $statement = '', array $parameters = []): array
    {
        $stmt = $this->executeStatement($statement, $parameters);

        return $stmt->fetchAll() ?: [];
    }

    private function executeStatement(string $statement = '', array $parameters = []): bool|PDOStatement
    {
        $stmt = $this->connection->prepare($statement);
        $stmt->execute($parameters);

        return $stmt;
    }
}