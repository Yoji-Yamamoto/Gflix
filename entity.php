<?php
    require_once("includes/header.php");

    if(!isset($_GET["id"])){
        ErrorMessage::show("No Id pass");
    }

    $entityId = $_GET["id"];
    $entity = new Entity($con, $entityId);

    $preview = new PreviewProvide($con, $userLoggedIn);
    echo $preview->createPreviewVideo($entity);

    $seasonProvide = new SeasonProvide($con, $userLoggedIn);
    echo $seasonProvide->create($entity);

?>