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
  <style>
  	aside{
  		display:none;
  	}
  	#content{
	background-color: #ADF6C9;
	text-align: center;
	font-family: 'Indie Flower', cursive;
  	}
  	form input{
  		display: block;
        margin:auto;
  		margin-bottom: 10px;
        align-content: center;
  	}
     
	form button{
	border-radius: 10%;
	background-color:#17ad80;
    
	}
      
     
  	
  </style>
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
		<li class="active"><a id="width" href="reg.php">Belépek</a></li>
		<li><a href="gtest.php">Garfield-test</a></li>
		<li><a href="Forum/forum.php">Fórum</a></li>
		
 	</ul>
</nav>





<main>
<aside>
</aside>

<div id="content">
<?php 
    getAside(__FILE__);
    ?>

    
</div>
</main>
<footer class="gradient">
	
<div id="copyright">Copyright: Tirasz &trade; </div>
<div><a href="#top"> Oldal tetejére ^</a></div>


</footer>
</body>
</html>
