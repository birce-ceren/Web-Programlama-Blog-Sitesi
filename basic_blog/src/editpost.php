<?php
session_start();
error_reporting(0);
if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}
require('Database.php');
$db = new Database();

if (isset($_GET['id'])) {
    $post = $db->row("*", "blogs", array('id' => $_GET['id']));
    $canEdit = $post['owner'] == $_SESSION['user']['id'];
}
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
    <?php echo renderHeader(); ?>
</div>

<main role="main" class="container">
    <div class="row d-flex justify-content-center">
        <form action="savePost.php" method="post">
            <?php
                if($canEdit){
                    echo "<input name='id' value='{$_GET['id']}' hidden>";
                }
            ?>
            <div class="card">
                <div class="card-header">
                    <?php if (isset($post)) {
                        $title = $post['title'];
                        $article = $post['article'];
                    } ?>
                    <input type="text" class="form-control" aria-label="Sizing example input"
                           aria-describedby="inputGroup-sizing-default" value="<?php echo $title ?>" name="title"
                           placeholder="Title">
                </div>
                <div class="card-body" style="width: 30vw;">
                    <textarea name="article" class="form-control"
                              placeholder="Enter your article" rows="6"><?php echo $article ?></textarea>
                    <div class="d-flex justify-content-end mt-1">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>
        </form>

    </div><!-- /.row -->

</main><!-- /.container -->


</body>
</html>
