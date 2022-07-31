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
  <link rel="stylesheet" href="css/gtest.css">
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
		<li class="active" ><a href="gtest.php">Garfield-test</a></li>
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

<div id="alignment_wrap">
	<h1>Jellem</h1>
	<p>Egy élölény morális és személyes hozzáállásait a jelleme határozza meg.</p>
	<p>Ezeket mi 3x3 csoportba osztjuk "Jószívűség vs Gonoszság" és "Törvényesség vs Kaotikusság" alapján.</p>
	<p>Természetesen ettől mindenki saját személyiségének megfelelően eltérhet, s egy adott karakter a mindennapok során csak többé-kevésbé igazodik a jelleme diktált elvárásokhoz. Ezek a meghatározások csak iránymutatók, nem pontos forgatókönyvek.</p>
</div>	


<div id="table_wrap">
	<table>
		<caption>Garfield Személyiség-táblázata</caption>
	<thead>
		<tr>
			<th> </th><th class="lawful" id="lawful">Lafwul</th> <th class="neutral" id="neutral">Neutral</th> <th class="chaotic" id="chaotic">Chaotic</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<th class="good" id="good">Good</th> 
			<td headers="lawful good"></td> 
			<td headers="neutral good"></td> 
			<td headers="chaotic good"></td>
		</tr>
		<tr>
			<th class="neutral" id="neutral_hor">Neutral</th> 
			<td headers="lawful neutral_hor"></td> 
			<td headers="neutral neutral_hor"></td> 
			<td headers="chaotic neutral_hor"></td>
		</tr>
		<tr>
			<th class="evil" id="evil">Evil</th> 
			<td headers="lawful evil"> </td> 
			<td headers="neutral evil"></td> 
			<td headers="chaotic evil"></td>
		</tr>
	</tbody>
	<tfoot>
		
	</tfoot>
	</table>
</div>
<a name="testResult"></a>
<div id="results_wrap">
<?php 
   getResults();
    ?>   
</div>   
    
    

<div id="test_wrap">
 
	<h1>Tudj meg többet a személyiségedről!</h1>
	<p>Ha szeretnéd magadat is a táblázatban elhelyezni, töltsd ki a garfield-személyiség tesztet!</p>

	<form id="garfield_test" method="get" action="php/garfield_test.php">
		<!-- 
		1 kérdés jóságra
		1 kérdés kaotikusságra
		2 random garfield kérdés
		!-->
		<h2>Mennyire szereted a lasagnat?</h2>
		<label style="display:none" for="q0">Mennyire szereted a lasagnat?</label>
		 <label style="display:inline-block;" for="q0"> Egyáltalán nem</label><input type="range" name="q0" id="q0" min="0" max="100"><label style="display:inline-block;" for="q0"> Nagyon</label>

		<h2>Az őseidnek nem tetszenek a szokásaid. Hogy reagálsz?</h2>
		<input required type="radio" name="q1" id="q1_0" value="cc">
		<label for="q1_0"> Nem érdekel. </label>
		<input required type="radio" name="q1" id="q1_1" value="cg">
		<label for="q1_1"> Megkérem őket hogy a maguk dolgával törődjenek. </label>
		<input required type="radio" name="q1" id="q1_2" value="ll">
		<label for="q1_2"> Igazuk van, próbálsz megváltozni. </label>

		<h2>Van 10 kocka csokid. A tesód is szeretne belőle enni. Mennyit adsz neki?</h2>
		<input required type="number" id="q2" name="q2" min="0" max="10">

		<h2>Feladnál egy jó munkahelyet, ha a családodnak szüksége lenne rád?</h2>
		<input required type="radio" name="q3" id="q3_0" value="ce">
		<label for="q3_0">Nem.</label>
		<input required type="radio" name="q3" id="q3_1" value="ne">
		<label for="q3_1">Csak ha lenne egy B-tervem munkahely-ügyileg.</label>
		<input required type="radio" name="q3" id="q3_2" value="lg">
		<label for="q3_2">Persze, mindenképp.</label>

		<h2>Árultad már el valaha egy barátodat?</h2>
		<input required type="radio" name="q4" id="q4_0" value="ce">
		<label for="q4_0">Már többször is, néha megéri.</label>
		<input required type="radio" name="q4" id="q4_1" value="cn">
		<label for="q4_1">Egyszer.</label>
		<input required type="radio" name="q4" id="q4_2" value="ng">
		<label for="q4_2">Volt már hogy akartam, de nem tettem meg.</label>
		<input required type="radio" name="q4" id="q4_3" value="ll">
		<label for="q4_3">Eszembe se jutna ilyen.</label>

		<h2>Tiszteled és betartod a törvényeket?</h2>
		<input required type="radio" name="q5" id="q5_0" value="ll">
		<label for="q5_0">Igen, kérdés nélkül.</label>
		<input required type="radio" name="q5" id="q5_1" value="ne">
		<label for="q5_1">Ha épp hasznomra válik. Vannak törvények, amiket nem értek.</label>
		<input required type="radio" name="q5" id="q5_2" value="cc">
		<label for="q5_2">Sosem érdekeltek a törvények.</label>

		<h2>Egy halálos járvány terjed az országodban.</h2>
		<input required type="radio" name="q6" id="q6_0" value="cg">
		<label for="q6_0">Egy veszélyes akció keretében megkeresném a gyógymódot.</label>
		<input required type="radio" name="q6" id="q6_1" value="gg">
		<label for="q6_1">Amennyire csak tudok segítek a betegeken.</label>
		<input required type="radio" name="q6" id="q6_2" value="lg">
		<label for="q6_2">Elkerülném a fertőzötteket.</label>
		<input required type="radio" name="q6" id="q6_3" value="ce">
		<label for="q6_3">Elmenekülnék az országból, amíg lehet.</label>

		<h2>Elkövettél egy bűntényt. Mit teszel:</h2>
		<input required type="radio" name="q7" id="q7_0" value="lg">
		<label for="q7_0">Feladom magam.</label>
		<input required type="radio" name="q7" id="q7_1" value="ne">
		<label for="q7_1">Eltitkolom az egészet, ha kell hazudok.</label>
		<input required type="radio" name="q7" id="q7_2" value="ce">
		<label for="q7_2">Rákenem valakire.</label>
        <input required type="radio" name="q7" id="q7_3" value="cn">
		<label for="q7_3">Elmenekülök</label>
        
        <h2>Éhezés tör ki az országodban. Mit teszel:</h2>
		<input required type="radio" name="q8" id="q8_0" value="gg">
		<label for="q8_0">Megosztom másokkal amim van.</label>
		<input required type="radio" name="q8" id="q8_1" value="nn">
		<label for="q8_1">Megosztom másokkal a maradékom.</label>
		<input required type="radio" name="q8" id="q8_2" value="cn">
		<label for="q8_2">Ha rászorulok lopok.</label>
        <input required type="radio" name="q8" id="q8_3" value="ce">
		<label for="q8_3">Ellopok annyi ételt, amit csak tudok, majd eladom másoknak.</label>
        
        <h2>Milyen gyakran segítesz másokon?</h2>
		<input required type="radio" name="q9" id="q9_0" value="ee">
		<label for="q9_0">Szándékosan soha.</label>
		<input required type="radio" name="q9" id="q9_1" value="xn">
		<label for="q9_1">Ha "muszáj".</label>
		<input required type="radio" name="q9" id="q9_2" value="gg">
		<label for="q9_2">Amikor csak tudok</label>
        
        <?php 
        $path = explode(DIRECTORY_SEPARATOR, __FILE__);
        $file = end($path);
        echo "<input type=\"hidden\"  name=\"location\" value=\"$file\">";?>
		<button type="submit" id="g_test_submit" name="g_test_submit">Lássuk!</button>
	</form>
</div>



</div>
</main>



<footer class="gradient">
	
<div id="copyright">Copyright: Tirasz &trade; </div>
<div><a href="#top"> Oldal tetejére ^</a></div>


</footer>
</body>
</html>
