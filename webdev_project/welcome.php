<?php
// Check if the cookie is set
if (isset($_COOKIE['username'])) {
    echo "Welcome back, " . $_COOKIE['username'] . "!";
} else {
    echo "Welcome, guest!";
}
?>
