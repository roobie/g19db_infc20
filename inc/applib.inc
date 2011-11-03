<?php

	function append_sql($sql) {
		$filename = '../files/sql.txt';
	
		if(!is_file($filename)) {
			fclose(fopen($filename,"x")); //create the file and close it
		};
	    
	    //first, obtain the data initially present in the text file
	    $ini_handle = fopen($filename, "r");
	    $ini_contents = fread($ini_handle, filesize($filename));
	    fclose($ini_handle);
	    //done obtaining initially present data
	  
	    //write new data to the file, along with the old data
	    $handle = fopen($filename, "w+");
	        $writestring = $ini_contents . "\n" . $sql . "\n";
	        if (fwrite($handle, $writestring) === false) {
	            echo "Cannot write to text file. <br />";          
	        }
	    fclose($handle); 
	}
	
	function dev_set_full_error_reporting () {
		ini_set('display_errors',1); 
		error_reporting(E_ALL);
	}
	
	function get_webapp_root () {
		return (dirname(__FILE__) . '/');
	}
?>
