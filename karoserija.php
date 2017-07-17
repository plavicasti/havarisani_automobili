<?php
	session_start();
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Karoserija</title>
<link href="../style.css" rel="stylesheet" type="text/css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


</head>

<body>

<div id="wrapper">
		
	<header id="header">
		<h1 class="H">OTKUP HAVARISANIH I OŠTEĆENIH VOZILA</h1>
		<img src="../slike/LOGO.PNG" alt="logo">

		<nav id="reg">
			<ul>
			<?php 
				if(isset($_SESSION["email"])){
			?>
			<li><a id="odjava"> Odjava</a></li>
			<?php 
				}else{
			?>
			<li><a href="../registracija.php">Prijava/Registracija</a></li>
			<?php 
				}
			?>
		</ul>
		</nav>
		
		<nav id="nav">
			<ul>
				<li><a href="../kontaktirajte_nas.php"> Kontaktirajte nas</a></li>
				<li><a href="../gde_se_nalazimo.php"> Gde se nalazimo</a></li>
				<li><a href="../marke_automobila.php"> Marke automobila</a></li>
				<li><a href="../index.php"> Početna</a></li>
			</ul>
		</nav>
	</header>

	<div id="main">

		<?php

		require_once '../skripte/db_connect.php';

		$sql = "select * 
				from havarisana_vozila.autodelovi as a
					join havarisana_vozila.karoserija as b
				    on a.id_dela = b.id_dela";
		$result = mysqli_query($conn, $sql);
		if($result){
		?>
			<h3>U ponudi imamo sledeće delove karoserije:</h3>
		<?php	
			while($row = mysqli_fetch_assoc($result)){
				$naziv = ucfirst($row["naziv"]);
				$cena = $row["cena"];
				$stanje = $row["stanje"];
				$src = $row["slika_dela"];
				$boja = ucfirst($row["boja"]);

				$proizvod = new stdClass();
				$proizvod->naziv = $naziv;
				$proizvod->cena = $cena;
				$proizvod->src = $src;
				$br = "<br>";
			?>
				<div class="delovi">
					<img src="../<?php echo $src; ?>" alt="<?php echo $naziv; ?>" >
					<p><?php echo $naziv.$br, $cena."RSD".$br, $stanje.$br, $boja.$br; ?></p>
					<?php 
						if(isset($_SESSION["email"])){
					?>
					<input type="button" value="Poručite" onclick='poruciProizvod(<?php echo json_encode($proizvod); ?>)'>
					<?php 
						}
					?>
				</div>
			<?php
			}
		}else{
		?>
			<h3>Trenutno nemamo delove karoserije u ponudi. Hvala.</h3>
		<?php
		}
		?>
	</div>

	<div id="sidebar">
		<h2 class="line">Autodelovi</h2>	
		<p>Pored otkupa automobila, naša kuća bavi se i otkupom i prodajom autodelova pri čemu u ponudi imamo delove za gotovo sva vozila trenutno prisutna na tržištu. To podrazumeva: delove karoserije, delove motora, enterijer, a takođe u ponudi imamo i čelične i aluminijumske felne kao i gume. </p>
		<nav id="parts">
			<ul>
				<li><a href=""> Karoserija</a></li>
				<li><a href="delovi_motora.php"> Delovi motora</a></li>
				<li><a href="enterijer.php"> Enterijer</a></li>
				<li><a href="felne_i_gume.php"> Felne i gume</a></li>
			</ul>
		</nav>
	</div>

	<div id="footer">
		<h3 class= "H" ><a href= "../kontaktirajte_nas.php" > Kontaktirajte nas</a></h3>	
	</div>
</div>

	<script type="text/javascript" src="../skripte/obrada.js"></script>
	<script type="text/javascript">
		function poruciProizvod(proizvod){
			var tmp = proizvod
			tmp.tip = "karoserija"

			$(document).ready(function(){
				
				var form = $('<form action="../porudzbina.php" method="post">' +
				'<input type="hidden" name="proizvod" value=\'' + JSON.stringify(tmp) + '\'></input>' + '</form>')
				$('body').append(form)
				console.log(form)
				$(form).submit()

			})
		}
	</script>

</body>
</html>
