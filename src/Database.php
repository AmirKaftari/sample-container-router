<?php

declare(strict_types= 1);

namespace App;

use PDO;

class Database {
    public function __construct(
        private string $host,
        private string $name,
        private string $user,
        private string $password) {

    }
    public function getConnection(): PDO {
        $dns = "mysql:host={$this->host}; dbname={$this->name}";
        $pdoConnection = new PDO($dns, $this->user, $this->password);
        return $pdoConnection;
    }
}