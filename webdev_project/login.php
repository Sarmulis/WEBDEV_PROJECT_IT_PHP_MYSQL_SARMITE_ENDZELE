<?php
session_start();
require_once 'includes/db.php';
require_once 'classes/databases.php';

// Pārbauda, vai forma ir iesniegta
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Iegūst lietotāju no datubāzes
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = :username");
    $stmt->execute(['username' => $username]);
    $user = $stmt->fetch();

    // Pārbauda paroli
    if ($user && password_verify($password, $user['password'])) {
        // Iestata sesiju
        $_SESSION['username'] = $user['username'];
        $_SESSION['user_id'] = $user['id'];

        // Iestata sīkdatni pēdējam apmeklējumam
        setcookie('last_visit', date("Y-m-d H:i:s"), time() + 3600 * 24 * 30, '/'); // 30 dienas
        
        header("Location: index.php");
        exit;
    } else {
        $error = "Invalid username or password.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
<h2>Login</h2>
<?php if (isset($error)) : ?>
    <p style="color: red;"><?php echo $error; ?></p>
<?php endif; ?>

<form method="post">
    <label for="username">Username:</label>
    <input type="text" name="username" required><br>

    <label for="password">Password:</label>
    <input type="password" name="password" required><br>

    <button type="submit">Login</button>
</form>
</body>
</html>
