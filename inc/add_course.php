<?php

	$ccode = mysql_escape_string($_POST["ccode"]);
	$cname = mysql_escape_string($_POST["cname"]);

	require 'database_props.php';
	
	mysql_connect('localhost',$user,$password);
	@mysql_select_db($database) or die( "Unable to select database");
	
	$query="INSERT INTO course VALUES ('$ccode', '$cname')";
	mysql_query($query);
	
	require 'applib.inc';
	
	append_sql($query);
	
	$query_check = "SELECT * FROM course WHERE
					code = '$ccode' and
					name = '$cname'

					";
	
	$result = mysql_query($query_check);
	
	if (!$result) {
		echo '<div class="ui-state-error">FAIL. Try again or consult the webmaster.</div> Append the following info in the message, please: ' . date('l jS \of F Y h:i:s A');
	} else {
		$row = mysql_fetch_assoc($result);
		if ($row["code"] == "$ccode") {
			echo 'Result';
		} else {
			echo '<div class="ui-state-error">Course could not be added</div>';;
		}
	}	
	mysql_close();
?>
