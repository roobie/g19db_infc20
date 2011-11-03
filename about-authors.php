<?php 
	include('includes/functions.php');
	head('About the Authors'	); 
?>
			
			<?php sidebar(); ?>
			
			<div id="content">
				
				<div class="about-frame">
					<img alt="stan" src="img/authors/stan.jpg">
					<p><h2>Björn Roberg</h2>
					881026<br /><br />
					Björn gillar glass och Webbdesign. Han gillar andra saker med, men i denna kontext så är det i huvudsak dessa ämnen han helst pratar om.<br /><br />
					Han känner själv att han har lång väg att gå, vad gäller HTML, CSS, ECMAScript och PHP, men det kommer nog att gå snabbt att lära sig, tror han själv i alla fall.</p>
				</div>
				
				<div class="about-frame">
					<img alt="stan" src="img/authors/stan.jpg">
					<p><h2>Erik Samuelsson</h2>
					<?php lorem() ?>
				</div>
				
				<div class="about-frame">
					<img alt="stan" src="img/authors/stan.jpg">
					<p><h2>Pontus Åkerblom</h2>
					<?php lorem() ?>
				</div>
			
			</div>
		</div>
		<div id="main-bottom"></div>
	</div>	<!-- end #container -->

<?php
	foot();
?>
