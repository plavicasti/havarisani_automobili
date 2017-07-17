<?php
	session_start();
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Gde se nalazimo</title>
<link href="style.css" rel="stylesheet" type="text/css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


</head>

<body>
<div id="wrapper">

	<div>
		
	</div>
	
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
				<li><a href=""> Gde se nalazimo</a></li>
				<li><a href="marke_automobila.php"> Marke automobila</a></li>
				<li><a href="index.php"> Početna</a></li>
			</ul>
		</nav>
	</header>
	<div id="google_map" style="width:100%;height:400px"></div>

	
	

	<div id="footer">
		<h3 class= "H" ><a href= "kontaktirajte_nas.php" > Kontaktirajte nas</a></h3>
		
	</div>

	<script>
		function myMap() {
  			var myCenter = new google.maps.LatLng(44.8439411,20.4833734);
  			var mapCanvas = document.getElementById("google_map");
  			var mapProp = {center: myCenter, zoom: 11};
  			var map = new google.maps.Map(mapCanvas, mapProp);
  			var marker = new google.maps.Marker({
  				position: myCenter,
  				animation: google.maps.Animation.BOUNCE
  			});
  			var infowindow = new google.maps.InfoWindow({
    			content: "OTKUP HAVARISANIH I OŠTEĆENIH VOZILA LAX"
 			});
  			infowindow.open(map,marker);
  			marker.setMap(map);
  		}			
		
	</script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDZ1YgOntCbSgKHB8AKjO5xx7h0o8LlA7Y&callback=myMap"></script>
</div>	
	<script type="text/javascript" src="skripte/obrada.js"></script>
</body>
</html>

