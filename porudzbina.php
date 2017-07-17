<?php
	session_start();

	if(!isset($_SESSION["email"])){
		header("location: index.php");
	}

	$proizvod = json_decode($_POST["proizvod"]);
	$naziv = $proizvod->naziv;
	$cena = $proizvod->cena;
	$src = $proizvod->src;
	$tip = $proizvod->tip;
	$br = "<br>";
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Porudžbina</title>
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
		<h2>Proizvod koji želite da poručite: </h2>
		<div class="delovi">
			<img src="<?php echo $src; ?>" alt="<?php echo $naziv; ?>"
					<p><?php echo $naziv.$br, $cena."RSD".$br; ?></p>
		</div>
		
		<!-- Ovde pocinje forma za poručivanje -->
		<div id="porudzbina">
		<h2>Unesite podatke za porudžbinu: </h2>

			<form id="poruci-forma" method="post" action="tnx.php" >
				<br><input type="text" name="ime" placeholder="ime"><br>
				<br><input type="text" name="prezime" placeholder="prezime"><br>
				<br><input type="text" name="adresa" placeholder="adresa"><br>
				<br><input type="text" name="telefon" placeholder="telefon"><br>
				<br><input type="hidden" name="naziv" value="<?php echo $naziv; ?>"><br>
				<br><input type="hidden" name="cena" value="<?php echo $cena; ?>"><br>
				<br><input type="hidden" name="tip" value="<?php echo $tip; ?>"><br>
				<br><input type="submit" value="Poruči!"><br>
			</form><br>
		</div>
		<!-- Ovde se završava forma -->
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
		$(document).ready(function(){

			$("#poruci-forma").on('submit', function(e){
				// stopiranje podrazumevane aktivnosti za submit
				e.preventDefault()

				// dohvatanje vrednosti iz formulara
				var ime = $("#poruci-forma [name='ime']").val()
				var prezime = $("#poruci-forma [name='prezime']").val()
				var adresa = $("#poruci-forma [name='adresa']").val()
				var telefon = $("#poruci-forma [name='telefon']").val()
				var naziv = $("#poruci-forma [name='naziv']").val()
				var cena = $("#poruci-forma [name='cena']").val()
				var tip = $("#poruci-forma [name='tip']").val()

				// validacija duzine podataka
				if(ime.length == 0 || prezime.length == 0 || adresa.length == 0 || telefon.length == 0){
					alert("Niste uneli tražene podatke")
					return
				}

				// slanje vrednosti na server
				$.ajax({
					url: "skripte/porucivanje.php",
					data: {
						ime: ime,
						prezime: prezime,
						adresa: adresa,
						telefon: telefon,
						naziv: naziv,
						cena: cena,
						tip: tip
					},
					method: "POST",
					success: function(server_data){
						alert("Uspešno ste izvršili porudžbinu")
						window.history.back();
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