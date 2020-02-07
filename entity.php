<?php
    require_once("includes/header.php");

    if(!isset($_GET["id"])){
        exit("No ID passed page");
    }
    $preview = new PreviewProvide($con, $userLoggedIn);
    echo $preview->createPreviewVideo(null);
    

?>