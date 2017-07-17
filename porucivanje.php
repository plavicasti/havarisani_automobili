<?php

require_once 'db_connect.php';
require_once 'returnToClient.php';

session_start();

$id_korisnika = null;
$id_dela = null;

// ----------------------------------------------------------------------------

// dohvatanje id_korisnika
$email = $_SESSION["email"];
$sql = "select id_korisnika from korisnici where email='$email'";
$result = mysqli_query($conn, $sql);
if($result){
	$num_rows = mysqli_num_rows($result);
	if($num_rows == 0){
		$msg = "Nije pronađen korisnik sa email adresom ".$email;
		$status_code = 500;
		returnToClient($msg, $status_code);
	}
	$id_korisnika = mysqli_fetch_assoc($result)["id_korisnika"];
}else{
	$msg = "Postoji problem sa dohvatanjem korisnika";
	$status_code = 500;
	returnToClient($msg, $status_code);
}

// dohvatanje id_dela
$naziv = lcfirst($_POST["naziv"]);
$cena = floatval($_POST["cena"]);
$tip = $_POST["tip"];
$sql = "select a.id_dela 
		from havarisana_vozila.autodelovi as a
			join havarisana_vozila.$tip as b
		    on a.id_dela = b.id_dela
		where cena = $cena
			and naziv = '$naziv';";
$result = mysqli_query($conn, $sql);
if($result){
	$num_rows = mysqli_num_rows($result);
	if($num_rows == 0){
		$msg = "Nije pronađen odgovarajući deo: ".$naziv;
		$status_code = 500;
		returnToClient($msg, $status_code);
	}
	$id_dela = mysqli_fetch_assoc($result)["id_dela"];
}else{
	$msg = "Postoji problem sa dohvatanjem dela";
	$status_code = 500;
	returnToClient($msg, $status_code);
}

// unos nove porudžbine
$adresa = $_POST["adresa"];
$telefon = $_POST["telefon"];
$ime = $_POST["ime"];
$prezime = $_POST["prezime"];
$sql = "insert into porudzbine(id_korisnika, adresa_porudzbine, kontakt_telefon, id_dela, ime, prezime) values ($id_korisnika, '$adresa', '$telefon', $id_dela, '$ime', '$prezime')";
$result = mysqli_query($conn, $sql);
if(is_bool($result) && $result == false){
	$msg = "Postoji problem sa naručivanjem";
	$status_code = 500;
	returnToClient($msg, $status_code);
}

// uspešno završavanje skripta
returnToClient($msg, $status_code);

?>