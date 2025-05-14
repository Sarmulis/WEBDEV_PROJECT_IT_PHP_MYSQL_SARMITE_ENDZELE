<?php
require_once 'includes/db.php';
require_once 'classes/Service.php';

// Izveido Service klases objektu
$service = new Service($pdo);

// Pievieno jaunu pakalpojumu
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $desc = $_POST['description'];
    $img = $_POST['image'];

    $service->create($title, $desc, $img);
    header("Location: dashboard.php");
    exit;
}
?>

<h2>Add New Service</h2>
<form method="POST">
    <label for="title">Title:</label>
    <input type="text" name="title" required><br>

    <label for="description">Description:</label>
    <textarea name="description" required></textarea><br>

    <label for="image">Image URL:</label>
    <input type="text" name="image" required><br>

    <button type="submit">Add Service</button>
</form>
<a href="dashboard.php">Back to Dashboard</a>
