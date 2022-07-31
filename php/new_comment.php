<?php 
include("User.php");
session_start();


/*
echo "user: " . $_SESSION["currentUser"]->name;
echo "commentje: " . $_POST["comment_content"];
echo "file: " . $_POST["comments_file"];*/

try{
   
    if(!isset($_SESSION["currentUser"])){
        throw new Exception("Komment írásához be kell jelentkezni!!");
    }
    if(!isset($_POST["comment_content"])){
         throw new Exception("Komment írásához írni is kell kommentet! :o");
    }
    
$content = clearInput($_POST["comment_content"]);
    
   if(is_null($content)){
    throw new Exception("Üres komment nem engedélyezett!");
   }
    
$file = fopen($_POST["comments_file"], "a");
$author = $_SESSION["currentUser"]->name;

$Comment = array("content" => $content, "author" => $author);

fwrite($file, serialize($Comment) . "\n");
fclose($file);

    
}catch(Exception $e){
    $_SESSION["commentError"] = $e->getMessage();
}finally{
    header('Location: ..'. DIRECTORY_SEPARATOR . "Forum". DIRECTORY_SEPARATOR . "Posts" .DIRECTORY_SEPARATOR . $_SESSION["currentPost"] . ".php");
}










?>