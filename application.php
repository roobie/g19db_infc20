<?php
	$title="Database application";
	include 'include/header_no_sidebar.php';
?>

<script type="text/javascript">
$(function() {
	$( "#tabs" ).tabs();
});
</script>

<div id="tabs">
	<ul>
		<li><a href="#create">Create new</a></li>
		<li><a href="#update">Update</a></li>
		<li><a href="#search">Search</a></li>
		<li><a href="#common-searches">Common searches</a></li>
	</ul>
	
	<div id="create">
	<p>create a new student</p>
	</div>
	<div id="update">
	<p>update a student
	</div>
	<div id="search">
	<p>field</p>
	</div>
	<div id="common-searches">
	<p>list</p>
	</div>
</div>


<?php
	include 'include/footer.php';
?>