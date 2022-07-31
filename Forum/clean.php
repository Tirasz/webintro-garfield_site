<?php 
session_start();
$_SESSION["currentThread"] = "clean";
unset($_SESSION["currentPost"]);

header('Location: ..'.DIRECTORY_SEPARATOR . "forum.php");
?>