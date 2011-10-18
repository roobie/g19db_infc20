<?php

	$ssn = $_POST["ssn"];
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
	
	$query="INSERT INTO student VALUES (null, '$ssn', '$fname', '$lname', '$address', '$phone_nbr', '$email', '$type')";
	mysql_query($query);
	
	require 'applib.php';
	
	append_sql($query);
	
	$query_check = "SELECT * FROM student WHERE
					first_name = '$fname' and
					last_name = '$lname' and
					address = '$address' and
					phone_number = '$phone_nbr' and
					email = '$email' and
					type = '$type' or
					social_security_number = '$ssn'
					";
	
	$result = mysql_query($query_check);

	if (!$result) {
		echo '<div class="ui-state-error">FAIL. Try again or consult the webmaster.</div> Append the following info in the message, please: ' . date('l jS \of F Y h:i:s A');
	} else {
		$row = mysql_fetch_assoc($result);
		if ($row["first_name"] == "$fname") {
			echo 'OK - student added to database';
		} else {
			echo '<div class="ui-state-error">FAIL - student not added to database. Please try again...</div>';;
		}
	}	
	mysql_close();
?>
