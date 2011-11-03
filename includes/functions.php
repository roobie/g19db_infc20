<?php

	//	Header w/ dynamic pagetitle
	function head($pagename) {
		if($pagename) {
			$pagetitle = "$pagename | G19";
		}
		else {
			$pagetitle = 'G19';
		}
		include('includes/header.php');
	}
	
	//	Footer
	function foot() {
		include('includes/footer.php');
	}
	
	// Sidebar
	function sidebar() {
		include('includes/sidebar.php');
	}
	
	// Lorem Ipsum - Brödtext
	function lorem() {
		include('includes/lorem.php');
	}
	
?>



<?php

/* ==|== Application ============================================================================
	Alla funktioner som ska köras på Application-sidan.
   ============================================================================================== */

	// Application Menu - Övre delen i Application
	function app_menu() {
		include('includes/app/app_menu.php');
	}
	
	// Application Table - Nedre delen i Application
	function app_table() {
		include('includes/app/app_table.php');
	}
 
?>