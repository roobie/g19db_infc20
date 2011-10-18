<?php

function head($title = "Default") {
?>
<!doctype html>
<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]>	<html class="no-js ie6 oldie" lang="en"> <![endif]-->
<!--[if IE 7]>		<html class="no-js ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8]>		<html class="no-js ie8 oldie" lang="en"> <![endif]-->
<!-- Consider adding an manifest.appcache: h5bp.com/d/Offline -->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en">
<!--<![endif]-->
	<head>
		<meta charset="utf-8">
		<title><?php echo $title ; ?></title>
		<meta name="description" content="">
		<meta name="author" content="">
		<!-- Mobile viewport optimized: j.mp/bplateviewport -->
		<meta name="viewport" content="width=device-width,initial-scale=1">
		<!-- Place favicon.ico and apple-touch-icon.png in the root directory: mathiasbynens.be/notes/touch-icons -->
		<!-- CSS: implied media=all -->
		<!-- CSS concatenated and minified via ant build script-->
		<link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" href="css/smoothness/jquery-ui-1.8.16.custom.css">
		<link rel="stylesheet" type="text/css" href="colors/vibrant-ink.css">
		<!-- end CSS-->
		<link rel="icon" href="favicon.ico" type="image/x-icon"> 
		<!-- More ideas for your <head> here: h5bp.com/d/head-Tips -->
		<script src="js/libs/modernizr-2.0.6.min.js"></script>
		<script src="js/libs/jquery-1.6.4.min.js"></script>
		<script src="js/libs/jquery-ui-1.8.16.custom.min.js"></script>
	</head>
	<body>
	<!-- Container for all body (header inclusive) -->
		<div id="container">
			<header>
				<hr />
			</header>
			<!-- Content -->
			<div id="content">
<?php
}
?>

<?php
function foot() {
?>
			</div>
			<!-- end of div#content -->
			<div id="footer-container">
				<footer>						
					<hr />
						<p>
						<a href="test/index.html">Test this site!</a></p>					
				</footer>
			</div>
			<!-- end of div#footer-container -->
		</div>
		<!-- end of div#container -->
		<!-- scripts concatenated and minified via ant build script-->
		<script defer src="js/plugins.js"></script>
		<script defer src="js/script.js"></script>
		<!-- end scripts-->
	</body>
</html>
<?php
}
?>

<?php
function sidebar() {
?>
<!-- Sidebar -->
<div id="sidebar" class="all-rounded">
	<script type="text/javascript">
	$(function() {
		$( "#nav" ).accordion({
			event: "mouseover"
		});
	});
	</script>
	<div id="nav">
		<h3><a href="#">Main</a></h3>
			<div>
			<p><a href="index.php">Start</a></p>
			</div>
		<h3><a href="#">Project</a></h3>
			<div>
			<p><a href="application.php">Application</a></p>
			<p><a href="documentation.php">Documentation</a></p>
			</div>
		<h3><a href="#">Information</a></h3>
			<div>
			<p><a href="about.php">About the authors</a></p>
			<p><a href="info.php">About the platform</a></p>
			</div>
		<h3><a href="#">Sandbox</a></h3>
			<div>
			<p><a href="ajax.php">AJAX testing</a></p>
			<p><a href="test.php">Test PHP</a></p>
			</div>
	</div>
	<!-- end div#nav -->
</div>
<!-- End sidebar -->
<?php
}
?>

<?php
function app_head($title = "Default") {
?>
<!doctype html>
<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="en"> <![endif]-->
<!-- Consider adding an manifest.appcache: h5bp.com/d/Offline -->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en">
<!--<![endif]-->
	<head>
		<meta charset="utf-8">
		<title><?php echo ( $title ); ?></title>
		<meta name="description" content="">
		<meta name="author" content="">
		<!-- Mobile viewport optimized: j.mp/bplateviewport -->
		<meta name="viewport" content="width=device-width,initial-scale=1">
		<!-- Place favicon.ico and apple-touch-icon.png in the root directory: mathiasbynens.be/notes/touch-icons -->
		<!-- CSS: implied media=all -->
		<!-- CSS concatenated and minified via ant build script-->
		<link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" href="css/smoothness/jquery-ui-1.8.16.custom.css">
		<link rel="stylesheet" type="text/css" href="colors/vibrant-ink.css">
		<!-- end CSS-->
		<link rel="icon" href="favicon.ico" type="image/x-icon"> 
		<!-- More ideas for your <head> here: h5bp.com/d/head-Tips -->
		<script src="js/libs/modernizr-2.0.6.min.js"></script>
		<script src="js/libs/jquery-1.6.4.min.js"></script>
		<script src="js/libs/jquery-ui-1.8.16.custom.min.js"></script>
	</head>
	<body>
		<div id="container">
			<header id="no-sidebar">
				<a href="index.php">To the start page.</a>
				<br />
				<hr />
			</header>
			<!-- Content -->
			<div id="content-no-sidebar">
<?php
}
?>
<?php
function app_foot() {
?>
			</div>
			<div id="footer-container">
				<footer>
				<br />
					<a href="inc/create_database.php">Reset database!</a> | 
					<a href="inc/populate_database.php">Populate database!</a>
				</footer>
			</div>
		</div>
		<!--! end of #container -->
		<!-- scripts concatenated and minified via ant build script-->
		<script defer src="js/plugins.js"></script>
		<script defer src="js/script.js"></script>
		<!-- end scripts-->
	</body>
</html>
<?php
}
?>

