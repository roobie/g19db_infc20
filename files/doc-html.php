<h1 id="intro">Introduction</h1>
<p>For this project ...</p>

<h2>Background</h2>
<p>We have been assigned a project where we need to design and implement a student register client in a programming language of our choosing.
</p>

<h2>Goal</h2>
<p>Our goal is to create a versatile application for student and course management with as high compatibility between systems as possible. Our goal is to achieve this by using new (if not the latest) tools out there for database management as we seamlessly integrate these with a front end the user is familiar with.
</p>

<h2>Problems</h2>
<p>Due to our choice of using a web based application we need to make sure that all major browsers are supported and all web standards followed. There’s a major transition now where HTML and CSS are getting updated with all new features which really improves the overall experience in using web based applications and sites. The downside to this is that older browsers won’t support these new features at all so we need to carefully implement constrains and functions that work on both new and old software.</p>

<h2>Objectives</h2>

<h1 id="project-desc">Project Description</h1>

<h2>System description , requirements (specs)</h2>
<p>For the front end application we are using a live webpage built with HTML and CSS. The dynamic connections between all the different pages as well with the database is achieved using PHP scripting. We are using MySQL as our database because it offers a free and lightweight solution for this particular project.
<br /><br />
PHP has built in functions for managing a MySQL server which is achieved with the function prefix ”mysqli_”, but due to the security vulnerability with SQL injections we’ve chosen to use the newer, much improved, function called PDO. PDO offers a much safer implementation with SQL connection and with almost no vulnerability to SQL injections as compared to the older way. PDO also offers support for a wide numbers of different database server, for example Oracle, Microsoft SQL Server and of course MySQL. This offers a possibility to change the underlying database server without having to make time consuming changes of the PHP code.
</p>

<h2>EER and/or UML model</h2>
<div style="font-size:11px;">
	<img alt="This is the EER-model" src="img/documentation/eer-model.png" />
	<a href="resources/EER-db-model.pdf">PDF-version of model</a> ||
	<a href="includes/doc/doc_sql_used.php">See the SQL we used to create the database.</a>
</div>

<h2>Very short description of each module</h2>

<h2>Description of hardware and software which has been utilized in the project</h2>
<p>During our design and testing phases we have used different hardware as well as server operating system for a better compatibility and portability.
<br /><br />
Our first testing server is a dedicated Ubuntu Server running Apache2, PHP5 and MySQL 4. Hosting has been made possible over the Internet, http, to simulate a real world scenario. The second environment we designed our application in was a MacBook Pro −07 with OS X 10.7 running same software as described above but with only localhost access.</p>

<h2>Response times</h2>

<h2>Shortcomings of the project (bugs)</h2>
<p>When working with a well organized project you may come across multiple problems when including, if your files are properly stored in some nice folders structure such as:</p>

<ul style="list-style-type: none">
    <li>- src</li>
    <li>`- web</li>
    <li>`- bfo</li>
    <li>- lib</li>
    <li>- test</li>
</ul>

<p>as the include path's behaviour is somehow strange.<br />
The workaround I use is having a file (ex: SiteCfg.class.php) where you set all the include paths for your project such as:</p>

<p>
&lt;?php<br />
$BASE_PATH = dirname(__FILE__);<br />
$DEPENDS_PATH  = ".;".$BASE_PATH;<br />
$DEPENDS_PATH .= ";".$BASE_PATH."/lib";<br />
$DEPENDS_PATH .= ";".$BASE_PATH."/test";<br />
ini_set("include_path", ini_get("include_path").";".$DEPENDS_PATH);<br />
?&gt;
</p>

<p>Make all paths in this file relative to IT'S path. Later on you can import any file within those folders from wherever with inlude/_once, require/_once without worrying about their path.
Just cross fingers you have permissions to change the server's include path.</p>


<h2>Information about the next version</h2>