<?php

// povezivanje na bazu
// nakon izvršavanja, dostupna je promenljiva $conn
require_once 'db_connect.php';
// dostupna je funkcija returnToClient($msg, $status_code)
require_once 'returnToClient.php';

// ----------------------------------------------------------------------------

// provera da li je imamo podatke poslate sa klijenta
if(empty($_POST)){
	$msg = "$_POST je prazan";
	$status_code = 500;
	returnToClient($msg, $status_code);
}

// provera da li su konkretni podaci prisutni
if(!isset($_POST["ime"]) || !isset($_POST["prezime"]) || !isset($_POST["email"]) || !isset($_POST["password"]) || !isset($_POST["number"])){
	$msg = "Nisu svi podaci poslati";
	$status_code = 500;
	returnToClient($msg, $status_code);
}

// provera da li postoji korisnik sa istim email-om
$email = mysqli_real_escape_string($conn, trim($_POST["email"]));
$sql = "select * from korisnici where email='$email'";
$result = mysqli_query($conn, $sql);
if($result){
	$rowcount = mysqli_num_rows($result);
	if($rowcount > 0){
		$msg = "Već postoji korisnik sa istim emailom";
		$status_code = 500;
		returnToClient($msg, $status_code);
	}
}else{
	$msg = "Postoji problem sa izvršavanjem upita";
	$status_code = 500;
	returnToClient($msg, $status_code);
}

// unošenje novog korisnika u bazu
$ime = mysqli_real_escape_string($conn, trim($_POST['ime']));
$prezime = mysqli_real_escape_string($conn, trim($_POST['prezime']));
$password = password_hash(trim($_POST['password']), PASSWORD_DEFAULT);
$number = mysqli_real_escape_string($conn, $_POST['number']);

$sql = "insert into korisnici (ime, prezime, email, password, telefon) values ('$ime', '$prezime', '$email', '$password', '$number');";
$result = mysqli_query($conn, $sql);
if(is_bool($result) && $result == false){
	$msg = "Postoji problem sa unosom novog korisnika";
	$status_code = 500;
	returnToClient($msg, $status_code);
}

// uspešno završavanje skripta
returnToClient($msg, $status_code);

?>