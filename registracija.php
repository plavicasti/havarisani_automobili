<?php
	session_start();
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Registracija / Prijava</title>
<link href="style.css" rel="stylesheet" type="text/css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

</head>
<body>


<div id="wrapper">
	
	<header id="header">
		<h1 class="H">OTKUP HAVARISANIH I OŠTEĆENIH VOZILA</h1>
		<img src="slike/LOGO.PNG" alt="logo">
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

		<?php 
			if(!isset($_SESSION["email"])){
		?>
				<form id="reg-forma" >
					Vaše ime: <br><input type="text" name="ime" placeholder="ime"><br>
					Vaše prezime: <br><input type="text" name="prezime" placeholder="prezime"><br>
					Vaš e-mail: <br><input type="email" name="email" placeholder="email"><br>
					Vaš password: <br><input type="password" name="password" placeholder="password"><br>
					Vaš broj telefona: <br><input type="text" name="number" placeholder="011111111" maxlength="10"><br>
					<br><input type="submit" value="Registrujte se!" ><br><br><br><br>
				</form>



				<form id="prij-forma" >
					Vaš e-mail: <br><input type="email" name="email" placeholder="email"><br>
					Vaš password: <br><input type="password" name="password" placeholder="password"><br>
					<br><input type="submit" value="Ulogujte se!" ><br><br><br><br>
				</form>
		<?php 
			}
		?>
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

	<script type="text/javascript">
		function testEmail(email) {
			// minimalni email je: a@a.a
		    // provera za @
		    var atSymbol = email.indexOf("@")
		    if(atSymbol < 1) 
		    	return false

		    // provera za .
		    var dot = email.lastIndexOf(".")
		    if(dot < atSymbol + 2) 
		    	return false

		    // provera da li je . na kraju
		    if (dot == email.length - 1) 
		    	return false

		    return true
		}
		function testPhone(number){
			// provera duzine broja
			if(number.length < 8 || number.length > 10)
				return false

			// provera da li su samo cifre
			for(var i = 0; i < number.length; i++){
				var cifra = parseInt(number[i])
				if(isNaN(cifra))
					return false
			}

			return true
		}
	</script>

	<script type="text/javascript">
		$(document).ready(function(){

			$("#reg-forma").on('submit', function(e){
				// stopiranje podrazumevane aktivnosti za submit
				e.preventDefault()

				// dohvatanje vrednosti iz formulara
				var ime = $("#reg-forma [name='ime']").val()
				var prezime = $("#reg-forma [name='prezime']").val()
				var email = $("#reg-forma [name='email']").val()
				var password = $("#reg-forma [name='password']").val()
				var number = $("#reg-forma [name='number']").val()

				// validacija vrednosti za email
				if(testEmail(email) == false){
					alert("Niste uneli ispravan email")
					$("#reg-forma [name='email']").focus()
					return
				}

				// validacija duzine podataka
				if(ime.length == 0 || prezime.length == 0 || password.length == 0){
					alert("Niste uneli tražene podatke")
					return	
				}

				// validacija duzine broja telefona
				if(testPhone(number) == false){
					alert("Niste uneli ispravan broj telefona")
					$("#reg-forma [name='number']").focus()
					return
				}

				// slanje vrednosti na server
				$.ajax({
					url: "skripte/registracija.php",
					data: {
						ime: ime,
						prezime: prezime,
						email: email,
						password: password,
						number: number
					},
					method: "POST",
					dataType: "json",
					success: function(server_data){
						console.log(server_data.responseText)
						alert("Uspešno ste se registrovali")
						window.location = "index.php"
					},
					error: function(server_data){
						alert("Molimo pokušajte ponovo")
						console.log(server_data.responseText)
					}
				})
			})

			$("#prij-forma").submit(function(e){
				// stopiranje podrazumevane aktivnosti za submit
				e.preventDefault()

				// dohvatanje vrednosti iz formulara
				var email = $("#prij-forma [name='email']").val()
				var password = $("#prij-forma [name='password']").val()

				// validacija vrednosti za email
				if(testEmail(email) == false){
					alert("Niste uneli ispravan email")
					$("#prij-forma [name='email']").focus()
					return
				}

				// validacija duzine passworda
				if(password.length == 0){
					alert("Niste uneli lozinku")
					$("#prij-forma [name='password']").focus()
					return	
				}

				// slanje vrednosti na server
				$.ajax({
					url: "skripte/prijava.php",
					data: {
						email: email,
						password: password
					},
					method: "POST",
					dataType: "json",
					success: function(server_data){	
						console.log(server_data.responseText)	
						window.location = "index.php"
					},
					error: function(server_data){
						alert("Molimo pokušajte ponovo")
						console.log(server_data.responseText)
					}
				})
			})

		})
	</script>

</body>
</html>