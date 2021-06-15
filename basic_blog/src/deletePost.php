<?php
session_start();
error_reporting(0);
if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}
if (!isset($_GET['id'])) {
    echo "<script>if(confirm('Invalid Request')){window.location = '/'}else {window.location = '/'}</script>";
    exit();
}

require('Database.php');
$db = new Database();

$post = $db->row("*", "blogs", array('id' => $_GET['id']));
$canEdit = $post['owner'] == $_SESSION['user']['id'];

if(!$canEdit) {
    echo "<script>if(confirm('Unauthorized')){window.location = '/'}else {window.location = '/'}</script>";
    exit();
}

try {
    $delete = $db->delete("blogs", array("id" => $_GET['id']));
    if($delete) {
	echo "<script>if(confirm('Success')){window.location = '/'}else {window.location = '/'}</script>";
    }else {
	echo "<script>if(confirm('Error on delete. Please try again later.')){window.location = '/'}else {window.location = '/'}</script>";
    }
} catch (Exception $e) {
    echo '<script>alert("Bad Request")</script>';
}
exit();