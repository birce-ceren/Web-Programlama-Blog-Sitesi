<?php
function renderHeader(){
    return '<header class="blog-header py-3">
        <div class="row flex-nowrap justify-content-between align-items-center">
            <div class="col-4">
                <a class="blog-header-logo text-dark" href="index.php">Scafe Blog</a>
            </div>
            <div class="col-4 d-flex justify-content-end align-items-center">
                <a class="btn btn-sm btn-outline-primary mr-1" href="editpost.php">New Post</a>
                <a class="btn btn-sm btn-outline-secondary ml-1" href="logout.php">Sign Out</a>
            </div>
        </div>
    </header>';
}
?>