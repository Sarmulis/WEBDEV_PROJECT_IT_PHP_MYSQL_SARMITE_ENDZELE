<?php
class Database {
    private $host = "localhost";
    private $username = "Sarmite";
    private $password = "mypassword";
    private $dbname = "webdev_project";
    private $pdo;

    // Constructor for establishing connection
    public function __construct() {
        try {
            $this->pdo = new PDO("mysql:host={$this->host};dbname={$this->dbname}", $this->username, $this->password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }

    // Method to get the PDO instance
    public function getConnection() {
        return $this->pdo;
    }

    // Example method: Execute SQL query
    public function query($sql, $params = []) {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }
}
?>
