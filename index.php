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
		<li class="active"><a href="index.php"><img src="Images/home.jpg" alt="Home Button"></a></li>
		<li><a id="width" href="reg.php">Belépek</a></li>
		<li><a href="gtest.php">Garfield-test</a></li>
		<li><a href="Forum/forum.php">Fórum</a></li>
		  
 	</ul>
</nav>


<main>
<aside>
<?php
getAside(__FILE__);
?>
</aside>
    
    
<div id=content>
	<div id="index_wrapper">
		<h1>Üdv Garfield weboldalán!</h1>

		<p>Ez az oldal azt a cél szolgálja, hogy minden és mindenki ide kerüljön, aki szereti Garfieldot.
		A fórumunkon lehetőséged lehet hozzád hasonló emberekkel társalognod, és a személyiség teszt alapján akár szerepjátékot is játszhattok!</p>
		<p>Ha még esetleg nem hallottál volna Garfieldről, nem baj, itt egy kis rövid bemutató a kedvenc kis narancssárga macskánkról:</p>

		<p>Garfield cinikus, lusta, narancssárga színű macska, aki folyton az evésre gondol. Egy olasz étteremben született, innen az ételek, különösen az olasz ételek iránti szeretete. Kedvenc étele a lasagne és a pizza. Reggelenként az ő szemében a kávé igazi kincs. Utálja a hétfőket, a februári hónapot, a postásokat, a születésnapját, a kutyákat, a pókokat, a vekkerét és a mazsolát. Kedvenc időtöltése az evésen kívül az alvás és a tévénézés. A hétfőket legszívesebben átalussza. Gazdája, Jon rendszeresen fogyókúrára fogja, ilyenkor gyakori az éhséglátomás Garfieldnál és ez néha bonyodalmat okoz, pl. nyalogatja a szomszéd szobrát, amiről azt hiszi, hogy fagyi. A mindenféle étel mellett Jon páfrányát is meg szokta enni. Garfield és Ubul közt nem éppen felhőtlen a kapcsolat, Garfield borsónyi agyúnak találja Ubult, mindig lelöki az asztalról és kigúnyolja hosszú nyelve és mindenhova odanyáladzása miatt. Születésnapja előtt ünnepi képsorok tűnnek fel az újságban. Gazdája Jon Arbuckle.</p>


		<div id="comic_wrapper">
			<img src="Images/comic01.png" alt="Garfield-képregény" style="width:90%">
		</div>

	</div>
 


</div>
</main>
<footer class="gradient">
	
<div id="copyright">Copyright: Tirasz &trade; </div>
    
<div><a href="#top"> Oldal tetejére ^</a></div>


</footer>
</body>
</html>

<?php 

?>