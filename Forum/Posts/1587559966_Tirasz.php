<?php 
session_start();

$_SESSION["currentThread"] = "clean";
$_SESSION["currentPost"] = "1587559966_Tirasz";
header('Location: ..'.DIRECTORY_SEPARATOR ."..".DIRECTORY_SEPARATOR . "forum.php");
?>