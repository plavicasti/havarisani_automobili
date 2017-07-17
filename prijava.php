<?php
	
require_once 'db_connect.php';
require_once 'returnToClient.php';

// ----------------------------------------------------------------------------

// provera da li je imamo podatke poslate sa klijenta
if(empty($_POST)){
	$msg = "$_POST je prazan";
	$status_code = 500;
	returnToClient($msg, $status_code);
}

// provera da li su konkretni podaci prisutni
if(!isset($_POST["email"]) || !isset($_POST["password"])){
	$msg = "Nisu svi podaci poslati";
	$status_code = 500;
	returnToClient($msg, $status_code);
}

// provera da li je kombinacija email/password korektna
$email = mysqli_real_escape_string($conn, trim($_POST["email"]));
$sql = "select password from korisnici where email='$email'";
$result = mysqli_query($conn, $sql);
if($result){
	$rowcount = mysqli_num_rows($result);
	if($rowcount == 0){
		$msg = "Nema korisnika sa tim emailom";
		$status_code = 500;
		returnToClient($msg, $status_code);
	}
	$password_db = mysqli_fetch_assoc($result)['password'];
	$password = trim($_POST['password']);
	if(!password_verify($password, $password_db)){
		$msg = "Email i lozinka se ne slažu";
		$status_code = 500;
		returnToClient($msg, $status_code);
	}
}else{
	$msg = "Postoji problem sa izvršavanjem upita";
	$status_code = 500;
	returnToClient($msg, $status_code);
}

// sve je u redu, otvaramo novu sesiju
session_start();
$_SESSION["email"] = $email;

// uspešno završavanje skripta
returnToClient($msg, $status_code);

?>