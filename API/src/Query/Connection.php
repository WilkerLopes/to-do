<?php

namespace App\Query;

abstract class Connection
{
    /**
     * @var \PDO
     */
    protected $pdo;

    public function __construct()
    {
        $host = '127.0.0.1';
        $db   = 'pulse_test';
        $user = 'root';
        $pass = '';
        $port = '3306';
        $charset = 'utf8mb4';

        $options = [
            \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
            \PDO::ATTR_EMULATE_PREPARES   => false,
        ];
        $dsn = "mysql:host=$host;dbname=$db;charset=$charset;port=$port";
        try {
            $this->pdo = new \PDO($dsn, $user, $pass, $options);
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }
    }
}
