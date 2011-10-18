<?php 
	include 'inc/proto_ui.inc'; //UI functions.
	head( $title = "Information :: Specs" );
	sidebar();
?>

<?php phpinfo(); ?>
<style><!--
hr {width: 100%;} //phpinfo() has fixed width hr's... Why? Dunno...
--></style>
<script type="text/javascript">
$(function () {
	document.title = <?php echo $title ;?>; // phpinfo() changes the title... Baaaad stuff.
});
</script>
<?php
	foot();
?>
