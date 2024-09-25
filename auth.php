<?php
if (session_status() === PHP_SESSION_NONE) {
    ob_start();
    session_start();
}

if (!isset($_SESSION['user_id'])) {
    header("Location: /login.php");
    exit(); // Always include exit after header redirection to prevent further script execution
}
else

?>
