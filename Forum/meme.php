<?php 
session_start();
$_SESSION["currentThread"] = "meme";
unset($_SESSION["currentPost"]);

header('Location: ..'.DIRECTORY_SEPARATOR . "forum.php");
?>