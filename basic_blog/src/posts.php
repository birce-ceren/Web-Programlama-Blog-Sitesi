<?php
session_start();
error_reporting(0);
if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}
require('Database.php');
$db = new Database();
$posts = $db->result(0, "*", "blogs", null, 'creation_time', 'DESC');
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
    <div class="jumbotron p-3 p-md-5 text-white rounded" 
    style="
    background-image: url('https://images.pexels.com/photos/1647962/pexels-photo-1647962.jpeg');
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center;">
        <div class="col-md-6 px-0">
            <h1 class="display-4 font-italic">Featured Blog Post</h1>
            <?php
            $key = array_rand($posts);
            $featured = $posts[$key];
            ?>
            <h2><?php echo $featured['title'] ?></h2>
            <p class="lead my-3">
                <?php echo substr($featured['article'], 0, 50); ?>
                <a href="post.php?id=<?php echo $featured['id'] ?>">read more...</a>
            </p>
        </div>
    </div>
</div>

<main role="main" class="container">
    <div class="row">
        <div class="col blog-main">
            <h3 class="pb-3 mb-4 font-italic border-bottom">
                Latest posts from Scafe
            </h3>
            <?php foreach ($posts as $post) {
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

                echo createPost($post['id'], $post['title'], $post['article'], $date, $author, $post['owner']);
            } ?>
        </div><!-- /.blog-main -->
    </div><!-- /.row -->

</main><!-- /.container -->


</body>
</html>
