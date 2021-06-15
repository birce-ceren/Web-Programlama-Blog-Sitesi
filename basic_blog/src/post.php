<?php
session_start();
error_reporting(0);
if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}
require('Database.php');
$db = new Database();

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit();
}

$post = $db->row("*", "blogs", array('id' => $_GET['id']));
$canEdit = $post['owner'] == $_SESSION['user']['id'];

if (!isset($post)) {
    header("Location: index.php");
    exit();
}
include "post.component.php";
include 'header.component.php';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Posts</title>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"/>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>

<body>

<div class="container">
    <?php echo renderHeader() ?>
</div>

<main role="main" class="container">
    <div class="row">
        <div class="col blog-main">
            <?php
            if (isset($post['modification_time'])) {
                $date = substr($post['modification_time'], 0, -3);
            } else {
                $date = substr($post['creation_time'], 0, -3);
            }
            $row = $db->row('name, surname', 'users', array('id' => $post['owner']));
            if (!$row) {
                $author = '';
            } else {
                $author = "{$row['name']} {$row['surname']}";
            }

            echo createPost($post['id'], $post['title'], $post['article'], $date, $author, $post['owner']); ?>

        </div><!-- /.blog-main -->
    </div><!-- /.row -->

</main><!-- /.container -->


</body>
</html>