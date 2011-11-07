<?php 
	include('includes/functions.php');
	head();
?>
			
				<h1>SQL Format</h1> 
				<form id="sqlform" class="sqlinput"  method="post" action="sql.php">
					<div class="form_description"> 
						<h2>SQL Format</h2> 
					</div>
					<label class="description" for="inpsql">Input SQL:</label> 
					<div> 
							<textarea id="inpsql" name="sql" class="textarea medium" type="text" ></textarea> 
							<input  class="button_text" type="submit" name="submit" value="Format" /> 
					</div>
					<?php
						$sql = $_POST["sql"];
						define("PARSER_LIB_ROOT", dirname(__FILE__) . "/sqlparserlib/");
						require_once PARSER_LIB_ROOT."sqlparser.lib.php";
						function SQLFormatPHP($sql){
							return PMA_SQP_formatHtml(PMA_SQP_parse($sql));
						}
						if ($sql == null) {
						?>
					<p class="guidelines" id="text-area-caption"><small>e.g.: select * from person where pnr ='5342-343' </small></p>
					<?php
						}
					?>
				</form>
				
				<div id="sqlret">
				<?php
					if ($sql != null) {
						echo '<hr />';
						echo SQLFormatPHP($sql);
						echo '<hr />';
					}
				?>
				</div>
				<p>Make SQL looks more beautiful <a href="http://www.orczhou.com/sqlparser/">Powered by SQLParserLib</a></p> 
	
<?php 
	foot();
?>
