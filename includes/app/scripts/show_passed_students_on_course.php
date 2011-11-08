<?php 

	$term = $_POST['idc'];

	require 'database_props.php';

	try {
		$db = new PDO($pdo_connection_string, $user, $password);

		$st = $db->prepare("CALL GetHasStudiedByID(?)");

		$db->beginTransaction();
			$st->execute(array($term));

			// Building the table:
			//s.first_name, s.last_name, s.idstudent, c.name, h.grade
echo <<<EOB
	<table class="standard-table">

		<tbody>
		    <tr>
					<th scope="col">Student</th>
					<th scope="col">Course name</th>
					<th scope="col">Grade</th>
		    </tr>
EOB;

$result_set = $st->fetchAll();

foreach ($result_set as $row) {
	$id = $row[2];
	$name		= $row[0] . " " . $row[1];
	$course_name = $row[3];
	$course_grade = $row[4];
echo <<<EOB
			<tr class="grades-tr">
				<th id="student-row-$id" class="td-clickable" scope="row">$name</th>
				<td class="td-clickable">$course_name</td>
				<td class="td-clickable">$course_grade</td>
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