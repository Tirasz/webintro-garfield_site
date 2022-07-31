<?php
define("PHPDIR", __DIR__ . DIRECTORY_SEPARATOR . "php");
include(PHPDIR . DIRECTORY_SEPARATOR . "main.php");

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
    <div class="new_thread">
    <?php 
    if(isset($_SESSION["currentUser"])){
        
        if(isset($_SESSION["exception"])){
            $error = $_SESSION["exception"];
            unset($_SESSION["exception"]);
        }else{
            $error = " ";
        }
    ?>
		<form action="php/new_thread.php" method="post" enctype="multipart/form-data" id="submit_thread">
			<label for="thread_name"> Bejegyzés címe: </label>
			<input type="text" name="thread_name" id="thread_name" required>
			<h3>Melyik al-fórumba szeretnél posztolni?</h3>
			<input type="radio" id="clean" name="subthread" value="clean" required>
			<label for="clean">Garfieldről társalgás</label>
			<input type="radio" id="meme" name="subthread" value="meme" required>
			<label for="meme">Garfield-mémek</label>
			<label for="thread_content">A mondanivalód:</label>
			<div id="textarea_wrap">
			<textarea placeholder="Legyen tintatűrő a mondanivalód!" form="submit_thread" id="thread_content" name="thread_content" required></textarea>
			</div>
			<label for="thread_pic">Ha akarsz hozzá képet, válassz eggyet:</label>
			<input type="file" name="thread_pic" id="thread_pic">
            <?php 
            echo "<h3 style=\"color:red;\"> {$error} </h3>";
            ?>
			<button type="submit"> Posztolás</button>
		</form>
        <?php 
    }else{
        echo"<h1 style=\"color:red;\"> Új bejegyzés létrehozásához be kell jelentkezned! </h1>";
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
