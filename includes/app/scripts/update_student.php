<?php

	$ssn = mysql_escape_string($_POST["ssn"]);
	$fname = mysql_escape_string($_POST["fname"]);
	$lname = mysql_escape_string($_POST["lname"]);
	$address = mysql_escape_string($_POST["address"]);
	$phone_nbr = mysql_escape_string($_POST["phone_nbr"]);
	$email = mysql_escape_string($_POST["email"]);
	$type = mysql_escape_string($_POST["type"]);

	$db_id = $_POST['id'];

	$db = null;
	$data = array($ssn, $fname, $lname, $address, $phone_nbr, $email, $type);
	$query="UPDATE student WHERE idstudent='$db_id'
					SET
						social_security_number = ?,
						first_name = ?,
						last_name = ?,
						address = ?,
						phone_number = ?,
						email = ?,
						type = ?
						";

	try {
		$user = "g19usr";
		$password = "group19";
		$database = "g19db";

		$pdo_hostname = "mysql:host=localhost;";
		$pdo_dbname = "dbname=g19db";
		$pdo_connection_string = $pdo_hostname . $pdo_dbname;
		
		$db = new PDO($pdo_connection_string, $user, $password);

		$stmt = $db->prepare($query);

		$db->beginTransaction();
		$stmt->execute($data);

		$db->commit();
		
		$db = null;
	} catch (PDOException $e) {
		echo '<div class="ui-state-error">FAIL. Try again or consult the webmaster.</div> Append the following info in the message, please: ' . date_default_timezone_set('l jS \of F Y h:i:s A') . $e->getMessage();
	}
	
?>
