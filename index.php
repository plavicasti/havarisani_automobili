<?php
	session_start();
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Havarisana vozila</title>
<link href="style.css" rel="stylesheet" type="text/css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<script>
	$(document).ready(function() {
		var div = $("#commercial1");
		var div1 = $("#commercial2");
        div.animate({height: '40px', opacity: '0.4'}, "slow");
        div1.animate({height: '40px', opacity: '0.4'}, "slow");
        div.animate({height: '300px', opacity: '1'}, "slow");
        div1.animate({height: '300px', opacity: '1'}, "slow");
   		//$("#commercial1").fadeIn(1000).fadeOut(1000);
   		//$("#commercial2").fadeIn(1000).fadeOut(1000);
	});

</script>

</head>

<body>

<div id="wrapper">
	
	<header id="header">
		<h1 class="H">OTKUP HAVARISANIH I OŠTEĆENIH VOZILA</h1>
		<img src="slike/LOGO.PNG" alt="logo">

		<nav id="reg">
			<ul>
				<?php 
					if(isset($_SESSION["email"])){
				?>
				<li><a id="odjava"> Odjava</a></li>
				<?php 
					}else{
				?>
				<li><a href="registracija.php">Prijava/Registracija</a></li>
				<?php 
					}
				?>
			</ul>
		</nav>
		
		<nav id="nav">
			<ul>
				<li><a href="kontaktirajte_nas.php"> Kontaktirajte nas</a></li>
				<li><a href="gde_se_nalazimo.php"> Gde se nalazimo</a></li>
				<li><a href="marke_automobila.php"> Marke automobila</a></li>
				<li><a href=""> Početna</a></li>
			</ul>
		</nav>
	</header>
	
	<!-- Slide Show -->
	<div id="comm">
		<div id="commercial1">
			<p>Reklama</p>
		</div>
		<center>
 		<img class="show" src="slike/chevrolet1.jpeg"
  		style="width:50%">
  		<img class="show" src="slike/mazda11.jpg"
  		style="width:50%">
  		<img class="show" src="slike/mazda1.jpg"
  		style="width:50%">
  		</center>
  		<div id="commercial2">
			<p>Reklama</p>
		</div>
	</div>	

	<div id="baner">

	</div>


	<div id="main">
		<div class="block">
		<h2 class="line">Oštećeni automobili u voznom stanju</h2>
		<img src="slike/mazda2.jpg" alt="mazda2">
			<p>Naša auto kuća bavi se otkupom polovnih, oštećenih i blago havarisanih automobila. Takođe se bavimo i otkupom i prodajom autodelova za gotovo sve marke automobila zastupljene na tržištu. Prilikom otkupa automobila koji su u voznom stanju potrebno je imati u vidu da naša kuća otkupljuje sve automobile proizvedene od 1995.godine pa sve do najnovijih modela. Potrebno je da dovezete svoj automobil na procenu ili da nas kontaktirate radi dogovora o pregledu automobila.</p>
		</div>
		
		<div class="block">	
		<h2 class="line">Oštećeni automobili koji nisu u voznom stanju</h2>
		<img src="slike/golf55.png" alt="golf5">
			<p>Prilikom otkupa automobila koji nisu u voznom stanju, potrebno je da nam dostavite sve relevantne informacije o stanju u kojem se vaše vozilo nalazi, a to podrazumeva: stanje školjke automobila, stanje karoserije, stanje enterijera, stanje klima uređaja, stanje sklopa motora kao i instalacije. Naravno, pre pomenutog potrebno je dostaviti informacije o samom vozilu - marka, model, godina proizvodnje, motor, vlasnički list nad vozilom (saobraćajna dozvola na uvid). </p>	
		</div>
	</div>

	<div id="sidebar">
		<h2 class="line">Autodelovi</h2>	
		<p>Pored otkupa automobila, naša kuća bavi se i otkupom i prodajom autodelova pri čemu u ponudi imamo delove za gotovo sva vozila trenutno prisutna na tržištu. To podrazumeva: delove karoserije, delove motora, enterijer, a takođe u ponudi imamo i čelične i aluminijumske felne kao i gume. </p>
		<nav id="parts">
			<ul>
				<li><a href="parts/karoserija.php"> Karoserija</a></li>
				<li><a href="parts/delovi_motora.php"> Delovi motora</a></li>
				<li><a href="parts/enterijer.php"> Enterijer</a></li>
				<li><a href="parts/felne_i_gume.php"> Felne i gume</a></li>
			</ul>
		</nav>
	</div>
	<div><a href="http://info.flagcounter.com/l1JL">	<img src="http://s07.flagcounter.com/count2/l1JL/bg_FFFFFF/txt_000000/border_CCCCCC/columns_2/maxflags_10/viewers_0/labels_1/pageviews_1/flags_0/percent_0/" alt="Flag Counter" border="0">
	</a>
	</div>

	<div id="footer">
		<h3 class= "H" ><a href= "kontaktirajte_nas.php" > Kontaktirajte nas</a></h3>
		
	</div>

	<script>
// Automatic Slideshow - change image every 4 seconds
	var myIndex = 0;
	slider();

	function slider() {
    	var i;
    	var x = document.getElementsByClassName("show");
    	for (i = 0; i < x.length; i++) {
       		x[i].style.display = "none";
    	}
    myIndex++;
    if (myIndex > x.length) {myIndex = 1}
    	x[myIndex-1].style.display = "block";
    	setTimeout(slider, 3000);
	}
	</script>








	
	
	
	
</div>

	<script type="text/javascript" src="skripte/obrada.js"></script>

</body>
</html>
