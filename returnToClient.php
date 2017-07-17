<?php

$msg = "OK";
$status_code = 200; // OK

function returnToClient($msg, $status_code){
	// vraćanje rezultata izvršavanja skripta klijentu
	$ret_obj = new stdClass();
	$ret_obj->msg = $msg;
	$ret_obj->status_code = $status_code;

	echo json_encode($ret_obj);

	http_response_code($status_code);
	exit();
}

?>