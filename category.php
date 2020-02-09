<?php
    require_once("includes/header.php");

    if(!isset($_GET["id"])){
        ErrorMessage::show("no id error");
    }
    $preview = new PreviewProvide($con, $userLoggedIn);
    echo $preview->createCategoryPreview($_GET["id"]);

    $category = new Category($con, $userLoggedIn);
    echo $category->showCategory($_GET["id"]);

?>