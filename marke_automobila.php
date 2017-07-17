<?php
	session_start();
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Marke automobila</title>

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
				<li><a href="Kontaktirajte_nas.php"> Kontaktirajte nas</a></li>
				<li><a href="gde_se_nalazimo.php"> Gde se nalazimo</a></li>
				<li><a href=""> Marke automobila</a></li>
				<li><a href="index.php"> Početna</a></li>
			</ul>
		</nav>
	</header>

	<div id="main">
		<div id="block">

		<?php

		require_once 'skripte/db_connect.php';

		$sql = "select * from marke_automobila";
		$result = mysqli_query($conn, $sql);
		if($result){
		?>
			<h3>Otkupljujemo sledeće marke automobila:</h3>
		<?php	
			while($row = mysqli_fetch_assoc($result)){
				$naziv = ucfirst($row["naziv_marke"]);
				$src = $row["src_slike"];
			?>
				<div class="mark">
					<img src="<?php echo $src; ?>" alt="<?php echo $naziv; ?>" >
					<p><?php echo $naziv; ?></p>
				</div>
			<?php
			}
		}else{
		?>
			<h3>Trenutno ne otkupljujemo automobile. Hvala.</h3>
		<?php
		}
		?>
			
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

	<div id="footer">
		<h3 class="H"><a href="Kontaktirajte_nas.php"> Kontaktirajte nas</a></h3>
		
	</div>	

	</div>
	<script type="text/javascript" src="skripte/obrada.js"></script>

</body>
</html>
