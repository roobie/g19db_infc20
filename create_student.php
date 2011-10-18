<?php

	$fname = $_POST["fname"];
	$lname = $_POST["lname"];
	$address = $_POST["address"];
	$phone_nbr = $_POST["phone_nbr"];
	$email = $_POST["email"];
	$type = $_POST["type"];

	$user="g19usr";
	$password="group19";
	$database="g19db";
	mysql_connect('localhost',$user,$password);
	@mysql_select_db($database) or die( "Unable to select database");
	
	$query="INSERT INTO student VALUES (null, '$fname', '$lname', '$address', '$phone_nbr', '$email', '$type')";
	mysql_query($query);
	
	$query_check = "SELECT FROM student WHERE
					first_name = '$fname' and
					last_name = '$lname' and
					address = '$address' and
					phone_number = '$phone_nbr' and
					email = '$email' and
					type = '$type
					";
	
	$result = mysql_query($query_check);
	
	mysql_close();
	
	if ($result != null) {
		echo '<div id="result">OK</div>';
	} else {
		echo '<div id="result">FAIL</div>';
	}
?>