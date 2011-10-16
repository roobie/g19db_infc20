<?php
	$user="g19usr";
	$password="group19";
	$database="g19db";
	mysql_connect(localhost,$user,$password);
	@mysql_select_db($database) or die( "Unable to select database");
	
	$query="
	CREATE TABLE student (
		id int(10) NOT NULL auto_increment,
		first_name varchar(255) NOT NULL,
		last_name varchar(255) NOT NULL,
		phone_nbr_home varchar(255),
		phone_nbr_mobile varchar(255),
		email varchar(255) NOT NULL,
		
		PRIMARY KEY (id)
	";
	mysql_query($query);
	
	mysql_close();
	
	// Redirects to the referring page.
	header("Location: ".$_SERVER["HTTP_REFERER"]);
?>