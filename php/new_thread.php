<?php 
include("forumMain.php");
include("User.php");
define('MB', 1048576);
session_start();




try{
   if(!isset($_POST["thread_name"]) || !isset($_POST["thread_content"]) || !isset($_POST["subthread"])){
        throw new Exception("Tölts ki mindent!");
    }
    
    $t_name = clearInput($_POST["thread_name"]);
    $t_content = clearInput($_POST["thread_content"]);
    
    if(is_null($t_name) || is_null($t_content)){
       throw new Exception("Üresen nem lehet beadni egy postot!");
    }
     $img = saveImage();
   
    
    $newPost = new Post($_SESSION["currentUser"]->name, $t_content,$img);
    $newThread = new Thread($t_name, $newPost,$_POST["subthread"]);
    saveThread($newThread);
    header('Location: ..'. DIRECTORY_SEPARATOR . "Forum". DIRECTORY_SEPARATOR . "Posts" . DIRECTORY_SEPARATOR . $newThread->src . ".php");

}catch(Exception $e){
    $_SESSION["exception"] = $e->getMessage();
    header('Location: ..' . DIRECTORY_SEPARATOR . "new_thread.php");
}



   

//var_dump($newPost->content->image);

/*echo "A thread címe: " . $newThread->title . "<br>";
echo "subthread: " . $newThread->subthread . "<br>";
echo "summary: " . $newThread->summary . "<br>";
echo "author: " . $newThread->content->author->name . "<br>";
echo "mit mond: " . $newThread->content->content . "<br>";
echo "image: " . $newThread->content->image;*/


function saveImage(){//megprobálja elmenteni a feltöltött file-t a helyére. exceptiont dob, ha valami nem jó. az image elérési utvonalát adja vissza, a main mappához nézve. {
//$_FILES["thread_pic"]
if ($_FILES["thread_pic"]['error'] == UPLOAD_ERR_NO_FILE) {
return null; // nem választott file-t
}
    
if($_FILES["thread_pic"]["error"] != UPLOAD_ERR_OK){
    if($_FILES["thread_pic"]["error"] <= 2){
        throw new Exception("A fájl túl nagy! Maximum: 2MB");
    }else{
        throw new Exception("Fáljfeltöltés sikertelen! Kérlek próbáld újra!");
    }
}    
    
$allowedTypes = array(IMAGETYPE_PNG, IMAGETYPE_JPEG, IMAGETYPE_GIF, IMAGETYPE_BMP);
$detectedType = exif_imagetype($_FILES['thread_pic']['tmp_name']);
    if(!in_array($detectedType, $allowedTypes)){
        throw new Exception("A fájlformátum nem megfelelő, vagy a fájl korrupt! <br> Elfogadott formátumok: .bmp .jpg .gif .png !");
    }
    $dir = "Forum/Uploads/" . time() . "_" . str_replace(' ', '_', $_SESSION["currentUser"]->name) . "_" . str_replace(' ', '_',$_FILES["thread_pic"]["name"]);
    //echo dirname(__DIR__) . DIRECTORY_SEPARATOR . $dir;
    if(move_uploaded_file($_FILES["thread_pic"]["tmp_name"], dirname(__DIR__) . DIRECTORY_SEPARATOR . $dir)){
        return $dir;
    }else{
       throw new Exception("Fáljfeltöltés sikertelen! Kérlek próbáld újra!"); 
    }
   	
    
}

?>