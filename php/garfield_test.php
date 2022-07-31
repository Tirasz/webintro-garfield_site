<?php 

include("User.php");
session_start();
$x = 0;// high:chaotic, low:lawful | max amit ellehet érni: 45, minimum: -45
$y = 0;// high:good,     low:evil  | max = 55, min = -50

for($i = 1; $i <= 9; $i++){
    $answer = $_GET["q".$i];
    if(is_numeric($answer)){//csak q2 az
        $y += ($answer - 5)*2; // így ha answer 0, 10et megy le, ha 10 akkor 10et megy fel.
    }else{
        // answerek 2 karakteres "alignment" kódok, amik az x és y tengelyen mozgatják az embert.
        //pl, egy "g" válasz a táblázatban "felfele" mozgatná az embert, 
        // a neutrális válaszok 0-hoz közelítik az embert mind2 tengelyen
        for($j = 0; $j <= 1; $j++){
            $a = $answer[$j];
            switch($a){            
                case "c": //chaotic 
                    $x += 5;
                    break;
                case "l": //lawful
                    $x -= 5;
                    break;
                    
                case "n": //neutral, itt fontos hanyadik. ha elso karakter, akkor x tengely, ha második akkor y tengely.
                    if($j == 0 && $x != 0){//x tengelyen, 0 felé közelit, ha 0 nem mozgatjuk
                      $sign = $x / abs($x);  //előjel
                      $x = (abs($x) - 5) * $sign;
                    }elseif($y != 0){//y tengelyen, 0 felé közelit
                      $sign = $y / abs($y);  //előjel
                      $y = (abs($y) - 5) * $sign;
                    }
                    break;
                
                case "e"://evil
                    $y -= 5;
                    break;
                case "g"://good
                    $y += 5;
                    break;
                default:// pl ha x, az csak azért, mert csak az egyik tengelyen neutrális, másikat nem mozgatja
                    break;
            }
        }
    }
    
    
}




$results = "";


if($x <= -15){ //(elharmadoljuk az x range-t (90/3)), min = -45, tehát -45-től -15 ig lawful, -15től 15ig neutral, 15 től 45ig chaotic 
    $results .= "Lawful ";
}elseif($x >= 15){
    $results .= "Chaotic ";
}else{
    $results .= "Neutral ";
}

if($y <= -15){//(elharmadoljuk az y ranget, (105/3)), min=-50, tehát -50től -15 ig evil, -15től 20 ig neutral, 20tól 55 ig good
$results .= "Evil";
}elseif($y >= 20){
    $results .= "Good";
}
else{
    $results .= "Neutral";
}

if(strcmp("Neutral Neutral",$results) == 0){
    $results = "True Neutral";
}
//echo $results;
//echo $_POST["location"];


$_SESSION["alignment"] = $results;
setcookie("alignment",$_SESSION["alignment"],time()+86400,"/"); //így azoknak is megmarad, akik nem regisztráltak, 1 napig.
if(isset($_SESSION["currentUser"])){
    $_SESSION["currentUser"]->alignment = $results;
    updateUser($_SESSION["currentUser"]);
}




header('Location: ..'.DIRECTORY_SEPARATOR . $_GET["location"] . "#testResult");

?>