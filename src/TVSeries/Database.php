<?php

namespace App\TVSeries;

/**
 * Class Database
 *
 * This class represents a simple database handler for managing TV series data using PDO.
 *
 * @package App\TVSeries
 */
class Database
{
    /**
     * @var \PDO Database connection object
     */
    private static $instance; // The singleton instance
    private $db;

    /**
     * Private constructor to prevent direct instantiation.
     *
     * @param string $host     The hostname of the database server.
     * @param string $username The username for connecting to the database server.
     * @param string $password The password for connecting to the database server.
     * @param string $database The name of the database.
     */
    private function __construct($host, $username, $password, $database)
    {
        try {
            $dsn = "mysql:host=$host;dbname=$database;charset=utf8mb4";
            $options = [
                \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
                \PDO::ATTR_EMULATE_PREPARES   => false,
            ];

            $this->db = new \PDO($dsn, $username, $password, $options);
        } catch (\PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    /**
     * Get the singleton instance.
     *
     * @param string $host     The hostname of the database server.
     * @param string $username The username for connecting to the database server.
     * @param string $password The password for connecting to the database server.
     * @param string $database The name of the database.
     *
     * @return Database The singleton instance.
     */
    public static function getInstance($host, $username, $password, $database)
    {
        if (self::$instance === null) {
            self::$instance = new self($host, $username, $password, $database);
        }

        return self::$instance;
    }

    /**
     * Create the database if it does not exist and set it as the active database.
     */
    public function createDatabase()
    {
        $this->db->exec("CREATE DATABASE IF NOT EXISTS tv_series_db");
        $this->db->exec('USE tv_series_db');
    }

    /**
     * Execute a SQL script on the connected database.
     *
     * @param string $script The SQL script to execute.
     */
    public function executeScript($script)
    {
        $this->db->exec($script);
    }

    /**
     * Perform a SQL query on the connected database.
     *
     * @param string $sql      The SQL query to execute.
     * @param array  $bindings Optional parameter for query bindings.
     *
     * @return \PDOStatement|bool The result of the query or false on failure.
     */
    public function query($sql, $bindings = [])
    {
        $stmt = $this->db->prepare($sql);
        $stmt->execute($bindings);

        return $stmt;
    }

    /**
     * Close the database connection.
     */
    public function close()
    {
        $this->db = null;
    }
}
