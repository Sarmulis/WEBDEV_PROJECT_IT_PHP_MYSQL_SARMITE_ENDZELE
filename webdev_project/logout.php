<?php
session_start();
session_unset();
session_destroy();

// Noņem sīkdatni
setcookie('last_visit', '', time() - 3600, '/');

header("Location: index.php");
exit;
