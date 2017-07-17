<?php
	session_start();
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Kontaktirajte nas</title>
<link href="style.css" rel="stylesheet" type="text/css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


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
				<li><a href=""> Kontaktirajte nas</a></li>
				<li><a href="gde_se_nalazimo.php"> Gde se nalazimo</a></li>
				<li><a href="marke_automobila.php"> Marke automobila</a></li>
				<li><a href="index.php"> Početna</a></li>
			</ul>
		</nav>
	</header>

	<div id="main">
		
		<!-- Ovde pocinje kontakt forma -->
		<?php 
			if(isset($_SESSION["email"])){
		?>
		<form id="kontakt-forma" method="post" action="tnx.php" >
			<br><input type="text" name="naslov" placeholder="naslov poruke"><br>
			<br><input type="email" name="email" placeholder="email"><br>
			<br><textarea name="poruka" rows="10" cols="50" placeholder="poruka"></textarea><br>
			<br><input type="submit" value="Pošalji!"><br>
		</form>
		<?php 
			}else{
		?>
			<h2>Da biste nas kontaktirali, molimo Vas da se prvo prijavite ili registrujete.</h2>
		<?php
			}
		?>

		<!-- Ovde se završava kontakt forma -->
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

	<div id="footer">
		<h3 class= "H" ><a href= "kontaktirajte_nas.php" > Kontaktirajte nas</a></h3>
		
	</div>
</div>

	<script type="text/javascript" src="skripte/obrada.js"></script>
	<script type="text/javascript">
		$(document).ready(function () {
			
			$("#kontakt-forma").submit(function (e) {
				// stopiranje podrazumevane aktivnosti za submit
				e.preventDefault()

				// dohvatanje vrednosti iz formulara
				var naslov = $("#kontakt-forma [name='naslov']").val()
				var email = $("#kontakt-forma [name='email']").val()
				var poruka = $("#kontakt-forma [name='poruka']").val()

				// validacija duzine podataka
				if(naslov.length == 0 || email.length == 0 || poruka.length == 0){
					alert("Niste uneli tražene podatke")
					return
				}

				// slanje vrednosti na server
				$.ajax({
					url: "skripte/kontakt.php",
					data: {
						naslov: naslov,
						email: email,
						poruka: poruka
					},
					method: "POST",
					success: function(server_data){
						alert("Hvala Vam što ste nas kontaktirali")
						window.location = "index.php";
					},
					error: function(server_data){
						alert("Molimo pokušajte ponovo")
						console.log(server_data)
					}
				})
			})

		})
	</script>

</body>
</html>
