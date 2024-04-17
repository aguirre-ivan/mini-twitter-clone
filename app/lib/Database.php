<?php

/**
 * Database Class
 * 
 * Handles database connection and provides access to the PDO instance.
 */
class Database
{
    /**
     * @var PDO $pdo The PDO instance for the database connection.
     */
    private $pdo;

    /**
     * @var Database|null $instance The singleton instance of the Database class.
     */
    private static $instance;

    /**
     * Constructs a new Database instance.
     * 
     * Establishes a PDO connection using the database credentials defined in the config.
     */
    public function __construct()
    {
        $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME;
        $this->pdo = new PDO($dsn, DB_USER, DB_PASS);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    /**
     * Gets the singleton instance of the Database class.
     * 
     * @return Database The singleton instance.
     */
    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Gets the PDO instance.
     * 
     * @return PDO The PDO instance.
     */
    public function getPdo()
    {
        return $this->pdo;
    }

    /**
     * Gets the connection status of the PDO instance.
     * 
     * @return string The connection status.
     */
    public function getConnectionStatus()
    {
        return $this->pdo->getAttribute(PDO::ATTR_CONNECTION_STATUS);
    }
}
