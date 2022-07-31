<?php 
include("Thread.php");


function displayThreadsFrom($subthread){
    $threads_list = loadThreads();
    $isEmpty = true;
if(!is_null($threads_list)){
    foreach($threads_list as $thread){ // végigmegyek a threadeket tartalmazó fájlon, kiolvasva belöle a threadeket
       if(strcmp($thread->sub,$subthread) == 0){ // ha a thread ugyanabba az alforumba tartozik, mint amit keresek, display()-elem
            $isEmpty = false;
            $thread->display(); 
       }
   }
}
    if($isEmpty){ //ha nemtalálok egy olyat se amit keresek
        echo "<h1> Még nincsenek itt bejegyzések!</h1>";
    }

}

function displayPost($src){
 $post = getPost($src);
 $post->displayPost();
}


?>