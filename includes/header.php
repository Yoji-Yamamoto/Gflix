<?php
    require_once("includes/config.php");
    require_once("includes/classes/PreviewProvide.php");
    require_once("includes/classes/Category.php");
    require_once("includes/classes/Entity.php");
    require_once("includes/classes/EntityProvide.php");

    if(!isset($_SESSION["userLoggedIn"])){
        header("Location: register.php");
    }

    $userLoggedIn = $_SESSION["userLoggedIn"];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="assets/stylesheets/style.css">
    <script src="https://code.jquery.com/jquery-3.4.1.js"
  integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
  crossorigin="anonymous"></script>
  <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
  <script src="assets/js/script.js"></script>
    <title>welcome to Gflix</title>
</head>
<body>
      <div class="wrapper">

