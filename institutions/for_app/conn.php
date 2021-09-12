<?php

// just simple connecting with localhost 
try {
	$connection= new mysqli("localhost","root","","institutions");
	echo "yes";
} catch (mysqliException $exc) {
	echo "Connection Failed";
	exit();

}

?>
