<?php 
	include 'inc/proto_ui.inc'; //UI functions.
	head( $title = "Sandbox :: AJAX" );
	sidebar();
?>
	<form action="/" id="searchForm">
		<input type="text" name="s" placeholder="Search..." />
		<input type="submit" value="Search" />
	</form>
	<!-- the result of the search will be rendered inside this div -->
	<div id="result"></div>

	<script>
		/* attach a submit handler to the form */
		$("#searchForm").submit(function(event) {

			/* stop form from submitting normally */
			event.preventDefault(); 
				
			/* get some values from elements on the page: */
			var $form = $( this ),
				term = $form.find( 'input[name="s"]' ).val(),
				url = $form.attr( 'action' );

			/* Send the data using post and put the results in a div */
			$.post( url, { s: term },
				function( data ) {
					var content = $( data ).find( '#content' );
					$( "#result" ).empty().append( content );
				}
			);
		});
	</script>

<?php
	foot();
?>
