<?php
	$title="Database application";
	include 'include/header_no_sidebar.php';
?>


<script type="text/javascript">
$(function() {
	$( "#tabs" ).tabs({
		event: "mouseover"
	});
});
</script>

<div id="tabs" class="left-col">
	<ul>
		<li><a href="#create">Create new</a></li>
		<li><a href="#update">Update</a></li>
		<li><a href="#search">Search</a></li>
		<li><a href="#common-searches">Common searches</a></li>
	</ul>
	
	<div id="create">
		<a href="#create-student">Create a student</a> | 
		<a href="#create-course">Create a course</a>
		<div id="create-student" class="forms">
			<h3>Create student:</h3>
			<form action="create_student.php" method="post">
			<p>Student Name: <input type="text" name="student-name" /></p>
			</form>
			<br />
		</div>
		
		<div id="create-course" class="forms">
			<h3>Create course:</h3>
			<form action="myform.php" method="post">
			<p>Course Name: <input type="text" name="course-name" /></p></form>
			<br />
		</div>
	</div>
	<div id="update">
	</div>
	<div id="search">
	</div>
	<div id="common-searches">
	</div>
</div>

<div class="right-col all-rounded">
<table class="standard-table"><caption>This is where data and stuff will be.</caption>
  <tr>
    <th scope="col">Product</th>
    <th scope="col">1st quarter</th>
    <th scope="col">2nd quarter</th>
    <th scope="col">3rd quarter</th>
    <th scope="col">4th quarter</th>
  </tr>
  <tr>
    <th scope="row">SupaWidget</th>
    <td>$9,940</td>
    <td>$10,100</td>
    <td>$9,490</td>
    <td>$11,730</td>
  </tr>
  <tr>
    <th scope="row">WonderWidget</th>
    <td>$19,310</td>
    <td>$21,140</td>
    <td>$20,560</td>
    <td>$22,590</td>
  </tr>
  <tr>
    <th scope="row">MegaWidget</th>
    <td>$25,110</td>
    <td>$26,260</td>
    <td>$25,210</td>
    <td>$28,370</td>
  </tr>
  <tr>
    <th scope="row">HyperWidget</th>
    <td>$27,650</td>
    <td>$24,550</td>
    <td>$30,040</td>
    <td>$31,980</td>
  </tr>
</table>
</div>

<?php
	include 'include/footer_app.php';
?>