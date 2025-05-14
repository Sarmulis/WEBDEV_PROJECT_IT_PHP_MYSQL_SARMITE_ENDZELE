<?php
require_once 'includes/db.php';
require_once 'classes/Service.php';

// Izveido Service klases objektu
$service = new Service($pdo); // Izmanto $conn, kas ir no db.php

// Pārbauda, vai ir norādīts ID
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Iegūst pakalpojumu pēc ID
    $stmt = $conn->prepare("SELECT * FROM services WHERE id = :id");
    $stmt->execute(['id' => $id]);
    $serviceData = $stmt->fetch();
    
    // Pārbauda, vai pakalpojums eksistē
    if (!$serviceData) {
        die("Service not found.");
    }
} else {
    die("No service ID specified.");
}

// Atjauno pakalpojumu
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = htmlspecialchars(trim($_POST['title']));
    $desc = htmlspecialchars(trim($_POST['description']));

    $service->update($id, $title, $desc);
    header("Location: dashboard.php");
    exit;
}
?>

<h2>Edit Service</h2>
<form method="POST">
    <label for="title">Title:</label>
    <input type="text" name="title" value="<?php echo htmlspecialchars($serviceData['title']); ?>" required><br>

    <label for="description">Description:</label>
    <textarea name="description" required><?php echo htmlspecialchars($serviceData['description']); ?></textarea><br>

    <button type="submit">Update Service</button>
</form>
<a href="dashboard.php">Back to Dashboard</a>
