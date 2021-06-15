<?php
session_start();
error_reporting(0);
if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}
if (!isset($_POST['title']) and !isset($_POST['article'])) {
    echo "<script>if(confirm('invalid request')){window.location = '/'}else {window.location = '/'}</script>";
    exit();
}
$title = $_POST['title'];
$article = $_POST['article'];
require('Database.php');

$db = new Database();
try {
    $insert = $db->insert(
        'blogs',
        array(
            'owner' => $_SESSION['user']['id'],
            'title' => $title,
            'article' => $article
        )
    );
    if ($insert) {
        echo "<script>if(confirm('Success')){window.location = '/'}else {window.location = 'register.php'}</script>";
    }
} catch (Exception $e) {
    echo '<script>alert("Bad Request")</script>';
}
exit();