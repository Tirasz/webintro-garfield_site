<?php 
include("User.php");
session_start();


unset($_SESSION["error"]); // csak a biztonság kedvéért kiürítjük


try{
//ha nincs kitöltve valami
if(!isset($_POST["nick"]) || !isset($_POST["passw"]) || !isset($_POST["email"]) || !isset($_POST["passw_confirm"])){ // ha bármit "elfelejt" kitölteni (bár minden input required szal ilyennek nemkéne történnie)
   throw new Exception("Minden mező kitöltése kötelező!");
}

 $username = clearInput($_POST["nick"]);
 $pass = validatePassword($_POST["passw"]); // üres stringet ad vissza, ha megfelel a jelszó, különben magát az errort dobja
    
 if(is_null($username)){
  throw new Exception("Nincs neved? :/");
 }
    
 if(strcmp($pass,"") != 0){
    throw new Exception($pass);
 }

if(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
    throw new Exception("Az email-cím formátuma helytelen! Helyes formátum: valami@valami.domain");
}

// ha találunk user-t ilyen névvel, akkor az már foglalt
if(isExistingUser($username) instanceof User){ 
   throw new Exception("Ez a felhasználónév már foglalt!!");
}
//megnézzük ugyanezt e-maillel
if(isExistingUser($_POST["email"]) instanceof User){
    throw new Exception("Ez az email-cím már foglalt!!");
}

if(strcmp($_POST["passw"], $_POST["passw_confirm"]) != 0){
    throw new Exception("Nem egyezik meg a két jelszó!");
}

// ha idáig eljutunk error nélkül, regisztrálhat (email, nick nem foglalt, jelszo jó )
   
$password = password_hash($_POST["passw"],PASSWORD_DEFAULT); // jelszavat hashelve tároljuk.
    
$tempUser = new User($username,$_POST["email"],$password);
    
if(isset($_COOKIE["alignment"])){ // ha már kitöltötte a tesztet, és vannak cookiek akkor betöltjük
   $_SESSION["alignment"] = $_COOKIE["alignment"];
}
    
if(isset($_SESSION["alignment"])){ // ha már kitöltötte a tesztet (így, ha vannak cookiek, megmarad)
$tempUser->alignment =  $_SESSION["alignment"];
}    
    
saveUser($tempUser); // elmentjük a user-t
$_SESSION["currentUser"] = $tempUser; // rögtön be is "jelentkeztetjük"

    
    
}catch(Exception $e){
    $_SESSION["error"] = $e->getMessage();
}finally{
    //location, hidden input, így bárhonnan be lehet jelentkezni, és ugyanoda fog visszadobni
    header('Location: ..'.DIRECTORY_SEPARATOR . $_POST["location"]);
}


function validatePassword($passw){ //return hibauzenet 
    //6 hosszu, egy nagybetu , csak abc betui es min 1 szam 
    $err = "";
    if(!empty($passw) && $passw != "" ){

    if (strlen($passw) < '6') {
        $err .="A jelszonak legalább 6 karakter hosszunak kell lennie! <br>";
    }
    elseif(!preg_match("#[0-9]+#", $passw)) {
        $err .= "A jelszonak legalább egy számot kell tartalmaznia!"."<br>";
    }
    elseif(!preg_match("#[A-Z]+#", $passw)) {
        $err .= "A jelszonak legalább egy nagybetut kell tartalmaznia!"."<br>";
    }
    elseif(!preg_match("#[a-z]+#", $passw)) {
        $err .= "A jelszonak legalább egy kisbetut kell tartalmaznia!"."<br>";
    }
    elseif(preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $passw)) {
        $err .= "A jelszo nem tartalmazhat speciális karaktereket!"."<br>";
    }
    }else{
        $err .= "Kérlek írj be egy jelszót!";
    }
    
    return $err;
}

?>