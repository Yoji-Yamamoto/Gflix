<?php
    require_once("includes/header.php");

    if(!isset($_GET["id"])){
        ErrorMessage::show("No Id pass");
    }

    $video = new Video($con, $_GET["id"]);
    $video->incrementViews();
?>

<div class="watchContainer">

    <div class="videoControl watchNav">
        <button onclick="goBack()">back</button>
         <img src="assets/images/back.png">
        <h3><?php echo $video->getTitle(); ?></h3>
    </div>
        <video controls autoplay>
            <source src="<?php echo $video->getfilePath(); ?>" type="video/mp4">
        </video>
</div>
<script>
    initVideo("<?php echo $video->getId(); ?>",
    "<?php echo $userLoggedIn; ?>");
</script>