<?php

	$conn = mysqli_connect("localhost","root","","havarisana_vozila");

	if($err = mysqli_connect_error($conn)){
		die("Greska u konekciji: ".$err."</br>");
	} 

	mysqli_set_charset($conn, "utf8");

?>
