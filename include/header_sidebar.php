<!doctype html>
<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="en"> <![endif]-->
<!-- Consider adding an manifest.appcache: h5bp.com/d/Offline -->
<!--[if gt IE 8]><!-->
<html
	class="no-js"
	lang="en">
<!--<![endif]-->
<head>
<meta charset="utf-8">

<title><?php echo ( $title ); ?></title>
<meta
	name="description"
	content="">
<meta
	name="author"
	content="">

<!-- Mobile viewport optimized: j.mp/bplateviewport -->
<meta
	name="viewport"
	content="width=device-width,initial-scale=1">

<!-- Place favicon.ico and apple-touch-icon.png in the root directory: mathiasbynens.be/notes/touch-icons -->

<!-- CSS: implied media=all -->
<!-- CSS concatenated and minified via ant build script-->
<link
	rel="stylesheet"
	href="css/style.css">
<link
	rel="stylesheet"
	href="css/smoothness/jquery-ui-1.8.16.custom.css">
<!-- end CSS-->

<!-- More ideas for your <head> here: h5bp.com/d/head-Tips -->

<script src="js/libs/modernizr-2.0.6.min.js"></script>
<script src="js/libs/jquery-1.6.4.min.js"></script>
<script src="js/libs/jquery-ui-1.8.16.custom.min.js"></script>
</head>

<body>

<div id="container">

<header>
	<hr />
</header>

<!-- Sidebar -->
<div
	id="sidebar"
	class="all-rounded">
	
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
		</div>
	</div>
</div>

<!-- Content -->
<div id="content">