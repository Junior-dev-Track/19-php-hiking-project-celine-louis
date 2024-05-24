<?php

namespace Models;

use Exception;
use PDO;
use PDOStatement;

require_once('config.php');

class Database
{
    private ?PDO $pdo = null;

    public function __construct()
    {
        try {
            $this->pdo = new PDO("mysql:host=" . HOST . ";dbname=" . DB . ";port=", LOGIN, PASSWORD);
            $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

            //We want any issues to throw an exception with details, instead of a silence or a simple warning
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function query(string $query, array $params = []): PDOStatement
    {
        $stmt = $this->pdo->prepare($query);
        $stmt->execute($params);

        return $stmt;
    }

    public function lastInsertId()
    {
        return $this->pdo->lastInsertId();
    }
}
