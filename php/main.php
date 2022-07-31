<?php 
include("User.php");
session_start();

function getAside($path){
$path = explode(DIRECTORY_SEPARATOR, $path);
$file = end($path);
if(isset($_SESSION["error"])){ // ha loginnál vagy reg-nél bármilyen hiba van.
    $error = $_SESSION["error"];
    unset($_SESSION["error"]); // rögtön unset-eljük, hogy refresh után eltünjön
}else{
    $error = " ";
}

// ha már bevan jelentkezve a user
if(isset($_SESSION["currentUser"])){ 
    $user = $_SESSION["currentUser"];
    // ha még nem töltötte ki a tesztet
    if(is_null($user->alignment)){ 
        $message = "<h3>Még nem töltötted ki a <a href = \"gtest.php\">személyiség-tesztet!</a></h3>";
        $classes = " ";
    }else{
        $message = "<h3>Nézz fel a <a href=\"Forum/forum.php\">Fórumra!</a> </h3>";
        $classes = getAlignmentClass($user->alignment);
    }
    //kiiratjuk a nevét, a megfelelő classekkel, és kiiratjuk a "motd"-t
     echo " 
    <div class=\"login\">
        <form action=\"php/logout.php\" method=\"post\">
            <h3>Üdv az oldalon, </h3> 
            <h2 style=\" border-radius:75%; border:3px solid black;\" {$classes} >$user->name</h2>
            <input type=\"hidden\" id=\"location\" name=\"location\" value=\"$file\">
            $message
            <button type=\"submit\" class=\"reg\" name=\"logout\">Kijelentkezés</button>
        </form> 
    </div>";    
    
// ha nincs bejelentkezve, ha van error ki írjuk   
}else{
    echo "
    <div class=\"login\">
	<form action=\"php/login.php\" method=\"post\">
			<h3>Bejelentkezés</h3>
			<label for=\"nick_log\"> Becenév: </label>
			<input type=\"text\" name=\"nick\" id=\"nick_log\" placeholder=\"Felhasználónév\" required>
			<label for=\"passw_log\"> Jelszó: </label>
			<input type=\"password\" name=\"passw\" id=\"passw_log\" required>
            <input type=\"hidden\" name=\"location\" value=\"$file\">
			<button type=\"submit\" class=\"reg\">Bejelentkezés</button>
	</form>
</div>
<div style=\" color:red;\"><h3>$error</h3></div>
<div class=\"reg\">
	<form action=\"php/register.php\" method=\"post\">
			<h3>Regisztráció</h3>
			<label for=\"email_reg\"> E-mail: </label>
			<input type=\"email\" name=\"email\" id=\"email_reg\" placeholder=\"valaki@pelda.hu\" required>
			<label for=\"nick_reg\"> Becenév: </label>
			<input type=\"text\" name=\"nick\" id=\"nick_reg\" placeholder=\"Felhasználónév\" required>
			<label for=\"passw_reg\"> Jelszó: </label>
			<input type=\"password\" id=\"passw_reg\" name=\"passw\" required>
			<label for=\"passw_confirm\"> Jelszó újra: </label>
			<input type=\"password\" id=\"passw_confirm\" name=\"passw_confirm\" required>
            <input type=\"hidden\" name=\"location\" value=\"$file\">
			<button type=\"submit\" class=\"reg\">Regisztrálok</button>
	</form>
</div>";
    
}
    
    
}

function getResults(){
    if(isset($_COOKIE["alignment"])){ //így ha nincs letiltva a cookie, betöltjük
		$_SESSION["alignment"] = $_COOKIE["alignment"];
	}
	
    if( isset($_SESSION["alignment"]) || (isset($_SESSION["currentUser"]) && !is_null($_SESSION["currentUser"]->alignment)) ){ // ki van töltve
        if(!isset($_SESSION["currentUser"])){ //bejelentkezés nélkül töltötte ki
            echo "<h2>A teszted eredménye:</h2> <br><h1" . getAlignmentClass($_SESSION["alignment"]) . " style=\"margin-top:0px; border-radius:50%;\">" . $_SESSION["alignment"] . "</h1> <br>";
            echo "Mentéshez regisztrálj! <br>";
        }else{ //felhasználo
            echo "<h2>" . $_SESSION["currentUser"]->name .", a teszted eredménye:</h2> <br><h1 " . getAlignmentClass($_SESSION["currentUser"]->alignment) . " style=\"margin-top:0px; border-radius:50%;\">" . $_SESSION["currentUser"]->alignment . "</h1> <br>";
        }    
        echo "A tesztet bármikor újratöltheted! :) <br>";
    } 
    
}

?>