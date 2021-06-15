<?php
    session_start();
    error_reporting(0);
    if (isset($_SESSION['user'])) {
        $_SESSION['user'] = null;
        header("Location: index.php");
    }
?>