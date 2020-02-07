<?php
    require_once("includes/header.php");

    if(!isset($_GET["id"])){
        exit("No ID passed page");
    }

    $entityId = $_GET["id"];
    $entity = new Entity($con, $entityId);

    $preview = new PreviewProvide($con, $userLoggedIn);
    echo $preview->createPreviewVideo($entity);


?>