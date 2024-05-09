<?php

declare (strict_types= 1);

namespace App;

use PDO;

class Repository {
    public function __construct(private Database $database) {

    }

    public function all(): array {
        $connection = $this->database->getConnection();
        $query = $connection->query("SELECT * FROM USERS");
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        return $results;
    }
}