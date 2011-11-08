<?php 
	
	$term = $_POST['search_term'];

	$term = "%$term%";

	require 'database_props.php';

	$data = array($term);

	try {
		$db = new PDO($pdo_connection_string, $user, $password);

		$st = $db->prepare("CALL GetAllCourses(?)");

		$db->beginTransaction();
			$st->execute($data);

			//$st->setFetchMode(PDO::FETCH_ASSOC);

			// Building the table:

echo <<<EOB
	<table class="standard-table">

    <caption>
  		To update a row, simply click it.
    </caption>

		<tbody>
    <tr>
			<th scope="col">Course</th>
			<th scope="col">code</th>
			<th scope="col">ID</th>
			<th scope="col">points</th>
    </tr>
EOB;

$result_set = $st->fetchAll();

foreach ($result_set as $row) {
	$id			= $row[0];
	$code		= $row[1];
	$name		= $row[2];
	$points		= $row[3];
echo <<<EOB
		<tr id="course-row-$id" class="course-tr">
			<th class="td-clickable" scope="row">$name</th>
			<td class="td-clickable">$code</td>
			<td class="td-clickable">$id</td>
			<td class="td-clickable">$points</td>
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