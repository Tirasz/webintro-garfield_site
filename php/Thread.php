<?php 
define("THREADS_FILE", dirname(__DIR__) . DIRECTORY_SEPARATOR . "data" . DIRECTORY_SEPARATOR . "threads.txt");
define("THREAD_PHP", dirname(__DIR__) . DIRECTORY_SEPARATOR . "Forum"  . DIRECTORY_SEPARATOR . "Posts" . DIRECTORY_SEPARATOR);
define("IMG_PATH", dirname(__DIR__) . DIRECTORY_SEPARATOR . "Forum"  . DIRECTORY_SEPARATOR . "Uploads" . DIRECTORY_SEPARATOR);
define("COMMENTS_PATH", dirname(__DIR__) .DIRECTORY_SEPARATOR . "Forum"  . DIRECTORY_SEPARATOR . "Comments" . DIRECTORY_SEPARATOR);



class Post{
    public $author;
    public $content;
    public $image;//HA feltölt valamit, ebbe kerül
    
    public $comments;
    
    function __construct($author, $content, $image) {
        $this->author = $author;
        $this->content = $content; //ha beleir bármien html taget, azt kiszedjuk, és  kicserélünk bármilyen newline-t <br> -re.
        $this->image = $image; // main mappához nézve, az img helye (vagy null, ha nincs)
        
    }
    
}

class Thread{
    
    public $title;
    public $subthread; //ez lesz az icon src-je
    public $content; //ez egy Post lesz, ebben lesz azimg
    public $summary = " ";
    public $sub;
    public $src;
    function __construct($title, $content, $subt) {
        $this->title = $title;
        $this->content = $content;
        $this->sub = $subt;
        $this->setSubThread($subt);
        $this->setSummary();
        $this->src = time() . "_" . str_replace(' ', '_', $this->content->author);
        $this->content->comments = $this->src . ".txt";
        $temp = fopen(COMMENTS_PATH . $this->content->comments,"x");
        fclose($temp);
    }
    
    
    function setSubThread($sub){
        if(strcmp($sub,"meme") == 0){
           $this->subthread = "Images/forum_folder2.png";
        }else{
            $this->subthread = "Images/forum_folder1.png";
        }
    }
    
    function setSummary(){
        $post = str_replace("<br>"," ",$this->content->content);
        $post = explode(" ",$post);
        for($i = 0; $i <= count($post)/3 && $i <= 10; $i++){
            $this->summary .= " " . $post[$i];
        }
        $this->summary .= "...";
    }
    
    function display(){
        $classes = getAlignmentClass(getAlignment($this->content->author));
        echo"<div class=\"thread\"> <a href=\"Forum/Posts/{$this->src}.php\"> <img src=\"{$this->subthread}\" alt=\"Garfield tartalom\">
			<div><p class=\"title\">{$this->title}</p><p class=\"summ\">{$this->summary}</p>
				<p class=\"forum_user\"><span {$classes} style=\"border: 1px solid black; border-radius:50%; padding-right:5px;\"> {$this->content->author} </span></p>
			</div> 
		</a> 
		</div>";
    }
    
    function loadComments(){
     $file = fopen(COMMENTS_PATH . $this->content->comments,"r");
     if(!$file){
         throw new Exception("Valami hiba történt!");
     }
        $isEmpty = true;
    while(!feof($file)){
       $comment = unserialize(fgets($file));
       
       if(!empty($comment)){
        $isEmpty = false;
       $comment_list[] = $comment; 
       }
   }
        if($isEmpty){
            fclose($file);
            throw new Exception("<div class=\"comment\"><p> Még nincsenek kommentek! </p></div>");
        }
        fclose($file);
        return $comment_list;
    }
    function getComments(){
        try{
            $comment_list = $this->loadComments();
                foreach($comment_list as $c){
                $classes = getAlignmentClass(getAlignment($c["author"]));
                echo"<div class=\"comment\"><div class=\"user_comment\"><span {$classes} style=\"border: 1px solid black; border-radius:50%; padding-right:5px;\">{$c["author"]}</span></div><p>{$c["content"]}</p></div>";
                }
        }catch(Exception $e){
            echo $e->getMessage();
        }
    
    }
    
    
    function displayPost(){
        if(isset($_SESSION["commentError"])){
            $error = $_SESSION["commentError"];
            unset($_SESSION["commentError"]);
        }
        else{
            $error = " ";
        }
        $srcDate= explode("_",$this->src);
        $date = date('Y.m.d.', $srcDate[0]);
        $classes = getAlignmentClass(getAlignment($this->content->author));
        echo"	<!-- Post címe, készítője ID FONTOS LESZ?-->
		<div class=\"thread\">  <a href=\"Forum/back.php\"><img  src=\"{$this->subthread}\" alt=\"Garfield tartalom\">
			<div><p class=\"title\">{$this->title}</p>
				<p class=\"forum_user\"><span {$classes} style=\"border: 1px solid black; border-radius:50%; padding-right:5px;\"> {$this->content->author} </span></p>
			</div>  
			</a>
		</div>
		<!--Post tartalma ID FONTOS LESZ?-->
		<div class=\"post_content\">";
        if(!is_null($this->content->image)){
            echo "<!-- Ha van kép, akk ide jön, amúgy csak tartalom(szöveg) -->
			<div id=\"post_picture\"><img alt=\"Garfield-meme\" src=\"{$this->content->image}\"></div>";
        }
        echo"<p>{$this->content->content}</p>
			</div>
            <span style=\"float:right; margin:10px;\">Posztolva: {$date} </span>";
        echo"
			<!--Kommentblokk  ID FONTOS LESZ?-->
		<div class=\"comments\">
			<!-- Kommentek-->";
        $this->getComments();
        $commentFile = COMMENTS_PATH . $this->content->comments;
	   	echo"	
		</div>
		<!--Új komment form -->
        <h3 style=\"color: red;\"> {$error} </h3>
		<div class=\"thread comment\" style=\"border-bottom:none;\"> <img src=\"Images/forum_new.png\" alt=\"Új hozzászólás\">
			<div><p class=\"title\">Új hozzászólás írása: </p></div> 
			<div id=\"new_comment_wrap\">
				<form id=\"new_comment\" action=\"php/new_comment.php\" method=\"post\">
					<textarea placeholder=\"Legyen tintatűrő a mondanivalód!\" form=\"new_comment\" id=\"comment_content\" name=\"comment_content\" required></textarea>
                    <input type=\"hidden\" name=\"comments_file\" value=\"{$commentFile}\">
					 <button type=\"submit\">Kommentelek</button>
				</form>
			</div>
		</div>";
    }
}



function saveThread(Thread $thread){
    
    $threads_file = fopen(THREADS_FILE, "a"); // elmentjük az "adatbázisba" lol
    fwrite($threads_file, serialize($thread) . "\n");
    fclose($threads_file);
    
    $phpfile = fopen(THREAD_PHP . $thread->src . ".php","x+"); // csinálunk neki egy php fáljt, amivel majd meglehet "nyitni"
    $toWrite = "<?php 
session_start();

\$_SESSION[\"currentThread\"] = \"{$thread->sub}\";
\$_SESSION[\"currentPost\"] = \"{$thread->src}\";
header('Location: ..'.DIRECTORY_SEPARATOR .\"..\".DIRECTORY_SEPARATOR . \"forum.php\");
?>";
    
fwrite($phpfile,$toWrite);
    fclose($phpfile);
}

function loadThreads(){
    $threads_file = fopen(THREADS_FILE, "r");
   while(!feof($threads_file)){
       $thread = unserialize(fgets($threads_file));
       if($thread instanceof Thread){
       $thread_list[] = $thread; 
       }
   }
    
    fclose($threads_file);
    
    
    if(isset($thread_list)){
    return $thread_list;
    }
    return null;
}



function getPost($src){
    //itt nem kell lekezelnem hogy null-e, hiszen ha az, el sem tudunk az oldalon idáig jutni
    $threads = loadThreads();
    foreach($threads as $t){
        if($t->src == $src){
            return $t;
        }
    }
}























?>