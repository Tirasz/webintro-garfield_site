<?php
define("PHPDIR", __DIR__ . DIRECTORY_SEPARATOR . "php");
include(PHPDIR . DIRECTORY_SEPARATOR . "main.php");
include(PHPDIR . DIRECTORY_SEPARATOR . "forumMain.php");
?>

<!DOCTYPE html>

<html lang="hu">
<head>
  <meta charset="utf-8">
  <title>Garfield is the best</title>
  <link rel="stylesheet" href="css/main.css">
  <link rel="stylesheet" href="css/forum.css">
</head>

<body>

<header>
	<a name="top"></a>
	<div>
<img src="Images/banner.jpg" alt="Weboldal Bannere">	
<h1>Garfield oldala</h1>
<img src="Images/banner.jpg" alt="Weboldal Bannere">	
	</div>
</header>

<nav class="gradient">
	<ul>
		<li><a href="index.php"><img src="Images/home.jpg" alt="Home Button"></a></li>
		<li><a id="width" href="reg.php">Belépek</a></li>
		<li><a href="gtest.php">Garfield-test</a></li>
		<li class="active"><a href="Forum/forum.php">Fórum</a></li>
		  
 	</ul>
</nav>


<main>
<aside>
<?php
getAside(__FILE__);
?>
</aside>


<div id=content>
	<div id="forum_container">
		<?php 
            if(!isset($_SESSION["currentThread"])){ // még nem választott a user alfórumot (meme/clean)
        ?>
		<div class="thread"> <a href="Forum/clean.php"> <img src="Images/forum_folder1.png" alt="Garfield tartalom">
			<div><p class="title">Garfieldről Társalgás</p><p class="summ">Minden és mindenki ide való, aki Garfield-hez kötődik.</p></div> 
		</a> 
		</div>
		<div class="thread"> <a href="Forum/meme.php"> <img src="Images/forum_folder2.png" alt="Gardieldes mémek">
			<div><p class="title">Garfieldes Mémek</p><p class="summ">Garfield és offtopic mémek, csak az erős idegzetűeknek.</p></div> 
		</a>  
		</div>
        <?php 
            }elseif(!isset($_SESSION["currentPost"])){ // alforumot már választott, de postot még nem
        ?>
        <div class="thread new"> <a href="new_thread.php"> <img src="Images/forum_new.png" alt="Új Bejegyzés">
            <div><p class="title">Új bejegyzés készítése</p><p class="summ">Bármi mondanivalód is van, ne tartsd bennt!</p></div> 
		</a> 
		</div>
        <?php
                
         displayThreadsFrom($_SESSION["currentThread"]);
                
        }elseif(isset($_SESSION["currentPost"])){
                
         displayPost($_SESSION["currentPost"]);
                
        }
        ?>
	</div>


</div>

</main>


<footer class="gradient">
<div id="copyright">Copyright: Tirasz &trade; </div>
<div><a href="#top"> Oldal tetejére ^</a></div>
</footer>
</body>
</html>
