<?php
	include('includes/functions.php');
	head('Application');
?>

			<?php sidebar(); ?>
			
			<div id="content">
				<?php app_menu() ?>
				<?php app_table() ?>
			</div>
			
		</div>

		<div id="main-bottom"></div>
	</div>	<!-- end #container -->

<?php foot(); ?>
