<?php
function createPost($id, $title, $content, $created, $owner, $ownerId)
{
    $article = substr($content, 0, 50);
    if(strlen($content) > 50) {
        $article .= "...";
    }
    if (isset($_SESSION['user'])) {
        if ($_SESSION['user']['id'] == $ownerId) {
            return "<div class='blog-post'>
                <div class='d-flex justify-content-between align-items-center'>
                    <a href='post.php?id={$id}'>
                        <h2 class='blog-post-title'>{$title}</h2>
                    </a>
                    <div>
                        <a href='deletePost.php?id={$id}' class='btn btn-sm btn-outline-danger'> Delete</a>
                        <a href='editpost.php?id={$id}' class='btn btn-sm btn-outline-success'>Edit</a>
                    </div>
                </div>
                <p class='blog-post-meta'>{$created} by <span class='text-muted'>{$owner}</span></p>
                {$article}
            </div><!-- /.blog-post -->
            <hr/>
        ";
        }
    }
    return "<div class='blog-post'>
                <a href='post.php?id={$id}'>
                    <h2 class='blog-post-title'>{$title}</h2>
                </a>
                <p class='blog-post-meta'>{$created} by <span class='text-muted'>{$owner}</span></p>
                {$article}
            </div><!-- /.blog-post -->
            <hr/>
        ";
}

?>