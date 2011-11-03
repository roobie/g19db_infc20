<?php
	
	require 'database_props.php';
	
	mysql_connect('localhost',$user,$password);
	@mysql_select_db($database) or die( "Unable to select database");
	
	//=========================================================================
	// TABLE DROPS && DEFS
	//=========================================================================
	
	//--- BEGIN:	INSERTS ---
	
	//--- BEGIN:	template ---
//	$query = "";
//	mysql_query($query);
	//--- END:		template ---
	
	$query="INSERT INTO student VALUES (null, '881026', 'Björn', 'Roberg', 'Ällingavägen 9B LGH 1409', '+46735088741', 'bjorn.roberg@gmail.com', 'domestic')";
	mysql_query($query);
	
	$query="INSERT INTO student VALUES (null, '880204' , 'Erik', 'Samuelsson', 'Järnåkravägen 27A', '+46708344566', 'erik.g.samuelsson@gmail.com', 'domestic')";
	mysql_query($query);
	
	$query="INSERT INTO student VALUES (null, '880730', 'Pontus', 'Åkerblom', 'Magistratsvägen 55Y', '+46705286178', 'pontusakerblom@gmail.com', 'domestic')";
	mysql_query($query);
	
	$query = "INSERT INTO student VALUES (null, 'null', 'John', 'Doe', 'Utbytesvägen 3', '+46708316458', 'j.doe@gmail.com', 'foreign')";
	mysql_query($query);
	
	//--- END:	INSERTS ---

	//=========================================================================
	
	mysql_close();
	
	// Redirects to the referring page.
	if (header("Location: ".$_SERVER["HTTP_REFERER"]) == 'localhost') {
			header("Location: ".$_SERVER["HTTP_REFERER"]);
	}
?>
