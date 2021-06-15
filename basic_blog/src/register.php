<?php
session_start();
error_reporting(0);
if (isset($_SESSION['user'])) {
    header("Location: posts.php");
    exit();
}

require 'Database.php';
if (isset($_POST["register"])) {
    if (!empty($_POST['blog_username']) and
        !empty($_POST['password']) and
        !empty($_POST['name']) and
        !empty($_POST['surname'])) {
        $db = new Database();
        try {
            $insert = $db->insert(
                'users',
                array(
                    'name' => $_POST['name'],
                    'username' => $_POST['blog_username'],
                    'surname' => $_POST['surname'],
                    'password' => $_POST['password']
                )
            );
            if($insert){
                echo "<script>if(confirm('Success')){window.location = '/'}else {window.location = 'register.php'}</script>";
            }
        } catch (Exception $e) {
            echo '<script>alert("Bad Request")</script>';
        }
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta content="text/html;charset=utf-8" http-equiv="Content-Type">
    <meta content="utf-8" http-equiv="encoding">
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <title>Blog - Register</title>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"/>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>

<body style="
      background-size: cover;
      background-repeat: no-repeat;
      background-color: #231f20;
      background-image: url('https://images.pexels.com/photos/3473569/pexels-photo-3473569.jpeg');
    ">
<div class="container-fluid d-flex justify-content-center" style="height: 100vh;align-items: center;">
    <div class="card card-signin my-5">
        <div class="card-body card-body align-items-center justify-content-center">
            <img src="/images/logo.png" alt="logo" class="responsive"
                 style="display: block; margin: 0 auto;width:300px"/>
            <hr class="my-4"/>
            <h5 class="card-title text-center">Blog - Register</h5>
            <form class="form-signin" action="" method="post">
                <div class="form-label-group">
                    <input type="text" name="blog_username" class="form-control"
                           placeholder="Username" required autofocus/>
                </div>
                <br>
                <div class="form-label-group">
                    <input type="text" name="name" class="form-control"
                           placeholder="Name" required autofocus/>
                </div>
                <br>
                <div class="form-label-group">
                    <input type="text" name="surname" class="form-control"
                           placeholder="Surname" required autofocus/>
                </div>
                <br>
                <div class="form-label-group">
                    <input type="password" name="password" id="inputPassword" class="form-control"
                           placeholder="Password" required/>
                </div>
                <br>
                <button
                        class="btn btn-sm btn-primary btn-block"
                        formmethod="post" type="submit" name="register">
                    Register
                </button>

        </div>
        </form>

        <a href="index.php"
           class="d-block text-center mb-3">
            Login
        </a>
        <p style="font-size: small; text-align: center;">
            2021 © Scafe Blogs. All rights reserved.
        </p>
    </div>

</div>
</div>
</body>

</html>