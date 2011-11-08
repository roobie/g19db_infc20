<?php

	$idcourse = mysql_escape_string($_POST["idc"]);



	$db = null;
	$data = array($idcourse);
	$query="CALL GetAllStudiesByCourseID(?)";

	try {
		require 'database_props.php';
		
		$db = new PDO($pdo_connection_string, $user, $password);

		$stmt = $db->prepare($query);

		$db->beginTransaction();
		$stmt->execute($data);
		
		// Building the table:

echo <<<EOB
	<table class="standard-table">

		<caption>
			To update a row, simply click it.
		</caption>

			<tbody>
				<tr>
						<th scope="col">Students</th>
				</tr>
				
EOB;

$result_set = $stmt->fetchAll();

foreach ($result_set as $row) {
$stud_id = $row[0];
echo <<<EOB
				
				<tr id="student-row-$stud_id" class="student-other-tr">
					<th class="td-clickable" scope="row">$stud_id</th>
				</tr>
EOB;
}

echo <<<EOB

		</tbody>
	</table>
EOB;

		$db->commit();

	} catch (PDOException $e) {
		echo $e->getMessage();
	}
?>
