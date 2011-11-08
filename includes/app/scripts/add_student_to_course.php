<?php

	$ssn = mysql_escape_string($_POST["ssn"]);
	$fname = mysql_escape_string($_POST["fname"]);
	$lname = mysql_escape_string($_POST["lname"]);
	$address = mysql_escape_string($_POST["address"]);
	$phone_nbr = mysql_escape_string($_POST["phone_nbr"]);
	$email = mysql_escape_string($_POST["email"]);
	$type = mysql_escape_string($_POST["type"]);

	$db = null;
	$data = array($ssn, $fname, $lname, $address, $phone_nbr, $email, $type);
	$query="CALL InsertStudent (?, ?, ?, ?, ?, ?, ?)";

	try {
		require 'database_props.php';
		
		$db = new PDO($pdo_connection_string, $user, $password);

		$stmt = $db->prepare($query);

		$db->beginTransaction();
		$stmt->execute($data);

		$last_id = $db->query('SELECT LAST_INSERT_ID() as last_id');
		$last_id->setFetchMode(PDO::FETCH_ASSOC);
		$last_id = $last_id->fetch();
		$last_id = intval($last_id['last_id']);
		
		$db->commit();
		
		$db = null;
	} catch (PDOException $e) {
		echo '<div class="ui-state-error">FAIL. Try again or consult the webmaster.</div> Append the following info in the message, please: ' . date_default_timezone_set('l jS \of F Y h:i:s A') . $e->getMessage();
	}	
?>
