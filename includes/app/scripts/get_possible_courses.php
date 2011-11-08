<?php 
	$sid = $_POST['sid'];

	require 'database_props.php';

	$data = array($sid);

	try {
		$db = new PDO($pdo_connection_string, $user, $password);

		$st = $db->prepare("CALL GetAllPossibleCoursesForStudent(?)");

		$db->beginTransaction();
			$st->execute($data);
		$db->commit();
		$result_set = $st->fetchAll();

		foreach ($result_set as $row) {
				echo "<option value=\"$row[0]\">$row[2] - $row[1]</option>";
		}
	} catch( PDOException $e ) {
		echo $e->getMessage();
	}
?>