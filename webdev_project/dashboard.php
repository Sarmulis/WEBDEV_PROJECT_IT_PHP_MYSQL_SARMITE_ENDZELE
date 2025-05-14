<?php
require_once 'includes/db.php';
require_once 'classes/Service.php';

// Izveido Service klases objektu
$service = new Service($pdo);
$services = $service->readAll();

// Dzēš pakalpojumu
if (isset($_GET['delete'])) {
    $service->delete($_GET['delete']);
    header("Location: dashboard.php");
    exit;
}
?>

<h2>Services Dashboard</h2>
<a href="add_service.php">Add New Service</a>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Description</th>
        <th>Image</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($services as $s): ?>
    <tr>
        <td><?php echo $s['id']; ?></td>
        <td><?php echo $s['title']; ?></td>
        <td><?php echo $s['description']; ?></td>
        <td><img src="<?php echo $s['image']; ?>" width="100"></td>
        <td>
            <a href="edit_service.php?id=<?php echo $s['id']; ?>">Edit</a>
            <a href="dashboard.php?delete=<?php echo $s['id']; ?>" onclick="return confirm('Are you sure?');">Delete</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
