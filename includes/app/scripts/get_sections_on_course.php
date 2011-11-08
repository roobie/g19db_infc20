<?php

	$idcourse = mysql_escape_string($_POST["idc"]);



	$db = null;
	$data = array($idcourse);
	$query="CALL GetAllSectionsByCourseID(?)";

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
						<th scope="col">Sections</th>
				</tr>
				
EOB;

$result_set = $stmt->fetchAll();

foreach ($result_set as $row) {
$sect_id = $row[0];
echo <<<EOB
				
				<tr id="section-row-$sect_id" class="section-other-tr">
					<th class="td-clickable" scope="row">$sect_id</th>
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
