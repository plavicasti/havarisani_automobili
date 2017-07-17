<?php

require_once 'db_connect.php';
require_once 'returnToClient.php';

session_start();

$id_korisnika = null;

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

// unos nove poruke
$naslov_poruke = $_POST["naslov"];
$sadrzaj_poruke = $_POST["poruka"];
$email = $_POST["email"];
$sql = "insert into poruke (id_korisnika, naslov_poruke, sadrzaj_poruke, email) values ($id_korisnika, '$naslov_poruke', '$sadrzaj_poruke', '$email')";
$result = mysqli_query($conn, $sql);
if(is_bool($result) && $result == false){
	$msg = "Postoji problem sa podnošenjem poruke";
	$status_code = 500;
	returnToClient($msg, $status_code);
}

returnToClient($msg, $status_code);

?>