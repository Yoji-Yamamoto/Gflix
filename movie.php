<?php
    require_once("includes/header.php");
    $preview = new PreviewProvide($con, $userLoggedIn);
    echo $preview->createmoviePreview(null);

    $category = new Category($con, $userLoggedIn);
    echo $category->showMovieCategories();

?>