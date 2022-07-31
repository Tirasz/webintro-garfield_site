<?php 
include("User.php");
session_start();
unset($_SESSION["error"]); // csak a biztonság kedvéért kiürítjük




try{
 
    //ha nincs kitöltve valami
if(!isset($_POST["nick"]) || !isset($_POST["passw"])){ // ha bármit "elfelejt" kitölteni (bár minden input required szal ilyennek nemkéne történnie)
throw new Exception("Minden mező kitöltése kötelező!");
}

$username = clearInput($_POST["nick"]);
// ha létezik, megkapjuk a usert
if(is_null($username)){
    throw new Exception("Nincs neved? :/");
}
$tempUser = isExistingUser($username); 

 // ha hamisat kapunk vissza, nem létezik
if($tempUser == false){
throw new Exception("Hibás felhasználónév! Biztos regisztráltál már?");
}
//ha nem egyeznek a jelszavak
if(!password_verify($_POST["passw"],$tempUser->passw)){
throw new Exception("Hibás jelszó! CAPS-LOCK?");
}

// ha eljutunk idáig, error nélkül, akkor be lehet "jelentkezni"
$_SESSION["currentUser"] = $tempUser;

    
}catch(Exception $e){
    $_SESSION["error"] = $e->getMessage();
}finally{
//location, hidden input, így bárhonnan be lehet jelentkezni, és ugyanoda fog visszadobni
header('Location: ..'.DIRECTORY_SEPARATOR . $_POST["location"]);
}




?>