<?php
// Database connection settings
$servername = "localhost";
$username = "Sarmite";
$password = "mypassword";
$dbname = "webdev_project";

// PDO database connection
try {
    // Create a PDO instance (Database connection)
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>
