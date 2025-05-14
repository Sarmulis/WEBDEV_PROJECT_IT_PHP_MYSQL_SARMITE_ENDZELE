<?php
// Iekļauj datubāzes savienojumu ar PDO
require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/classes/databases.php';

// Izveido jaunu Database klases instanci
$db = new Database();
$conn = $db->getConnection();

// Testē savienojumu
echo "Connected using Database class successfully<br>";

// Izveido datubāzi (ja neeksistē)
try {
    $conn->exec("CREATE DATABASE IF NOT EXISTS webdev_project");
    echo "Database created successfully<br>";

    // Pārslēdzies uz izveidoto datubāzi
    $conn->exec("USE webdev_project");

    // Iekļauj tabulu izveides skriptu
    include __DIR__ . '/includes/setup.php';

    // Izveido tabulas tikai, ja tās neeksistē
    if (!empty($services)) {
        $conn->exec($services);
        echo "Services table created successfully<br>";
    }

    if (!empty($users)) {
        $conn->exec($users);
        echo "Users table created successfully<br>";
    }
} catch (PDOException $e) {
    echo "Error setting up database: " . $e->getMessage() . "<br>";
}
?>
