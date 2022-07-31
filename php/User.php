<?php 
define("USERS_FILE", dirname(__DIR__) . DIRECTORY_SEPARATOR . "data" . DIRECTORY_SEPARATOR . "users.txt");
class User{
    
    public $name;
    public $alignment;
    public $email;
    public $passw;
    
    function __construct($name, $email, $passw) {
        
        $this->name = $name;
        $this->email = $email;
        $this->passw = $passw; // hashelve kapja
        $this->alignment = null;
    }
}




//echo USERS_FILE;

function saveUser(User $user){
    $users_file = fopen(USERS_FILE, "a");
    fwrite($users_file, serialize($user) . "\n");
    fclose($users_file);
}


function loadUsers(){
   $users_file = fopen(USERS_FILE, "r");
   while(!feof($users_file)){
       $user = unserialize(fgets($users_file));
       
       if($user instanceof User){
       $users_list[] = $user; 
       }
   }
    
    fclose($users_file);
    return $users_list;
}

function isExistingUser($nick){ // ha van felhasználo az adott névvel vagy e-maillel akkor megkapjuk a felhasználót, otherwise hamis.
    
    $userList = loadUsers();
    foreach($userList as $user){
        if($user->name == $nick || $user->email == $nick){
            return $user;
        }
    }
    return false;
    
}


function updateUser(User $user){ // egy frissítet user jön be, akinek a nevét biztosan nem változtathatjuk meg, így azalapján keresunk.
     $Users = loadUsers();// Usereket tartalmazó tömb
     $users_file = fopen(USERS_FILE, "w"); //maga a text file, amiben serializálva vannak tárolva
     rewind($users_file);  
     $i = 0;
    do{
        if(strcmp($Users[$i]->name, $user->name) == 0){//ha megvan a keresett user
          $Users[$i] = $user;//kicseréljük
        }
    
        fwrite($users_file, serialize($Users[$i]) . "\n"); 
        $i++;
    }while($i < count($Users)); 
    
    
    fclose($users_file);
}



function clearInput($string){
    if(strlen(trim($string)) == 0){
        return null;
    }
    else {
        return trim(preg_replace('~[\r\n]+~', ' ', filter_var($string, FILTER_SANITIZE_STRING)));
    }
}



function getAlignmentClass($alignment){
    if(!is_null($alignment)){
   $class = explode(" ",$alignment); 
     return " class=\"" . strtolower($class[0]) . " " . strtolower($class[1]) . "\"";
    }
    return " ";
}
function getAlignment($name){
    $user = isExistingUser($name);
    if($user instanceof User){
    return $user->alignment;
    }
    return " ";
}
?>