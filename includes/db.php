<?php

use Dotenv\Dotenv;
class DB {
    private mysqli $connection;

    public function __construct() {
        $dotenv = Dotenv::createImmutable(__DIR__ . '/../');
        $dotenv->load();

        $dbHost = $_ENV['DB_HOSTNAME'];
        $dbUsername = $_ENV['DB_USERNAME'];
        $dbPassword = $_ENV['DB_PASSWORD'];
        $dbName = $_ENV['DB_DATABASE'];

        $this->connection = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }
    }

    public function query($sql) {
        $result = $this->connection->query($sql);

        if (!$result) {
            die("Query failed: " . $this->connection->error);
        }

        return $result;
    }

    public function close(): void
    {
        $this->connection->close();
    }
}
