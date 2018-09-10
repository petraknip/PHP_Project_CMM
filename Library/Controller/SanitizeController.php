<?php
/**
 * Maakt alle tekstinput (op drie manieren) veilig.
 * 		
 * @param String $data
 * 
 * @return String 
 */
function sanit_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}