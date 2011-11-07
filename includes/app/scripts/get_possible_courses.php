<?php 
	$sid = $_POST['sid'];

	require 'database_props.php';

	try {
		$db = new PDO($pdo_connection_string, $user, $password);

		/**
			Use the $sid to get all courses that is possible for that student to get.
		**/

		$st = $db->prepare("
						SELECT *
						FROM course
						ORDER BY code
						");

		$db->beginTransaction();
			$st->execute($data);
		$db->commit();
		$result_set = $st->fetchAll();

		foreach ($result_set as $row) {
				echo "<option value=\"$row[0]\">$row[1] - $row[2]</option>";
		}
	} catch( PDOException $e ) {
		echo $e->getMessage();
	}
?>