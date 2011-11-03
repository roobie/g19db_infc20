<?php 
	include('includes/functions.php');
	head('Documentation'); 
?>

			<?php sidebar(); ?>
			
			<div id="content">

			    <div id="toc" class="all-rounded">
			        <h3>Table of contents</h3>
			
			        <ol>
			            <li><a href="#intro">Introduction</a></li>
			            <li><a href="#project-desc">Project Description</a></li>
			        </ol>
			    </div>
			
			    <h1 id="intro">Introduction</h1>
			    <p>For this project ...</p>
			    <h2>Background</h2>
			    <h2>Goal</h2>
			    <h2>Objectives</h2>
			    <h1 id="project-desc">Project Description</h1>
			    <h2>System description , requirements (specs)</h2>
			    <h2>EER and/or UML model</h2>
			
			    <div class="image-container">
			        <img alt="This is the EER-model" src="img/documentation/eer-model.png" /> 
			        <a href="db/model.pdf">PDF-version of model</a> ||
			        <a href="sql_used.php">See the SQL we used to create the database.</a>
			    </div>
			
			    <h2>Very short description of each module</h2>
			    <h2>Description of hardware and software which has been utilized in the project</h2>
			    <h2>Response times</h2>
			    <h2>Shortcomings of the project (bugs)</h2>
			
			    <div>
			        <p>When working with a well organized project you may come across multiple problems when including, if your files are properly stored in some nice folders structure such as:</p>
			
			        <ul style="list-style-type: none">
			            <li>- src</li>
			            <li>`- web</li>
			            <li>`- bfo</li>
			            <li>- lib</li>
			            <li>- test</li>
			        </ul>
			
			        <p>as the include path's behaviour is somehow strange.</p>
			        <p>The workaround I use is having a file (ex: SiteCfg.class.php) where you set all the include paths for your project such as:</p>
			        
			        <pre class="brush: php;">
			        	&lt;?php
			        	$BASE_PATH = dirname(__FILE__);
			        	$DEPENDS_PATH  = ".;".$BASE_PATH;
			        	$DEPENDS_PATH .= ";".$BASE_PATH."/lib";
			        	$DEPENDS_PATH .= ";".$BASE_PATH."/test";
			        	ini_set("include_path", ini_get("include_path").";".$DEPENDS_PATH);
			        ?&gt;
			        
					</pre>
			
			        <p>Make all paths in this file relative to IT'S path. Later on you can import any file within those folders from wherever with inlude/_once, require/_once without worrying about their path.</p>
			        <p>Just cross fingers you have permissions to change the server's include path.</p>
			    </div>
			
			    <h2>Information about the next version</h2>

			</div>
		</div>

	<div id="main-bottom"></div>
	</div>	<!-- end #container -->

<?php foot(); ?> 