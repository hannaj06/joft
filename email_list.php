<?php

function dB_connect(){
//define global dB connection variable
global $mysqli;

$mysqli = new mysqli("127.0.0.1", "<user>", "<pass>", "<db>");

if(mysqli_connect_errno()){
	printf("connect faild: %s\n ", mysqli_connect_error());
	exit();
}
}

function emailChecker($email){
global $mysqli, $check_res;

//check if email address already exists in dB
$check_sql = "SELECT email_id 
			  FROM email 
			  WHERE email_address = '" . $email . "'";

$check_res = mysqli_query($mysqli, $check_sql) or die(mysqli_error($mysqli));
}			  
?>