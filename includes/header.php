<!doctype html>
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/smoothness/jquery-ui-1.8.16.custom.css">
	<link rel="stylesheet" href="css/ui-lightness/jquery-ui-1.8.16.custom.css">
	<link rel="stylesheet" href="sqlparserlib/sqlsyntax.css" />
	<link rel="icon" href="favicon.ico" type="image/x-icon"> 
	
	<link type="text/css" rel="stylesheet" href="SyntaxHighlighter/styles/shCore.css"/>
	<link type="text/css" rel="Stylesheet" href="SyntaxHighlighter/styles/shThemeEclipse.css" />

	<!-- FONTS -->
	<link href='http://fonts.googleapis.com/css?family=Federant' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Jura' rel='stylesheet' type='text/css'>
	
	<script type="text/javascript" src="SyntaxHighlighter/scripts/XRegExp.js"></script>
	<script type="text/javascript" src="SyntaxHighlighter/scripts/shCore.js"></script>
	<script type="text/javascript" src="SyntaxHighlighter/scripts/shBrushPhp.js"></script>
	<script type="text/javascript">SyntaxHighlighter.all();</script>
		
	<script defer src="js/plugins.js"></script>
	<script defer src="js/script.js"></script>
	
	<script src="js/libs/modernizr-2.0.6.min.js"></script>
	<script src="js/libs/jquery-1.6.4.min.js"></script>
	<script src="js/libs/jquery-ui-1.8.16.custom.min.js"></script>
	
	<title><?php echo $pagetitle; ?></title>

</head>

<body>

<div id="wrapper">

	<div id="header">
		<div id="logo">
			<img  src="img/logo.png" />
		</div>
	</div>
	
	<div id="container">
		<div id="main-top">
			<div id="main-top-text"><h3><?php echo $pagename; ?></h3>
			</div>
		</div>
		<div id="main">
			<?php sidebar(); ?>
			
			<div id="content">