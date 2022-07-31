<?php 
session_start();
unset($_SESSION["currentPost"]);

header('Location: ..'.DIRECTORY_SEPARATOR . "forum.php");
?>

