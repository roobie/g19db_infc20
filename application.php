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
		<li><a href="#create">Create</a></li>
		<li><a href="#update">Update</a></li>
		<li><a href="#search">Search</a></li>
		<li><a href="#common-searches">Common searches</a></li>
	</ul>
	
	<div id="create">
		<script type="text/javascript">
		$(function() {
			var fname		= $( "#fname" ),
			lname				= $( "#lname" ),
			address			= $( "#address" ),
			phone_nbr		= $( "#phone_nbr" ),
			email				= $( "#email" ),
			allFields	= $( [] )	.add( fname )
													.add( lname )
													.add( address )
													.add( phone_nbr )
													.add( email ),
			tips = $( ".validateTips" );

			function updateTips( t ) {
				tips
					.text( t )
					.addClass( "ui-state-highlight" );
				setTimeout(function() {
					tips.removeClass( "ui-state-highlight", 1500 );
				}, 500 );
			}

			function checkLength( o, n, min, max ) {
				if ( o.val().length > max || o.val().length < min ) {
					o.addClass( "ui-state-error" );
					updateTips( "Length of " + n + " must be between " +
						min + " and " + max + "." );
					return false;
				} else {
					return true;
				}
			}

			function checkRegexp( o, regexp, n ) {
				if ( !( regexp.test( o.val() ) ) ) {
					o.addClass( "ui-state-error" );
					updateTips( n );
					return false;
				} else {
					return true;
				}
			}
			
			$( "#create-student-dialog-form" ).dialog({
				autoOpen: false,
				height: 400,
				width: 400,
				modal: true,
				buttons: {
					"Create!": function() {
						var bValid = true;
						allFields.removeClass( "ui-state-error" );

						bValid = bValid && checkLength( fname, "fname", 3, 16 );
						bValid = bValid && checkLength( lname, "lname", 3, 16 );
						bValid = bValid && checkLength( address, "address", 5, 16 );
						bValid = bValid && checkLength( phone_nbr, "phone_nbr", 5, 16 );
						bValid = bValid && checkLength( email, "email", 6, 80 );

						bValid = bValid && checkRegexp( fname, /^[a-z]([0-9a-z_åäö])+$/i, "First name may consist of a-z + å, ä and ö, 0-9, underscores, begin with a letter." );
						bValid = bValid && checkRegexp( lname, /^[a-z]([0-9a-z_åäö])+$/i, "Last name may consist of a-z + å, ä and ö, 0-9, underscores, begin with a letter." );
						bValid = bValid && checkRegexp( address, /^[a-z]([0-9a-z_])+$/i, "Username may consist of a-z + å, ä and ö, 0-9, underscores, begin with a letter." );
						bValid = bValid && checkRegexp( phone_nbr, /^[a-z]([0-9a-z_])+$/i, "Username may consist of a-z + å, ä and ö, 0-9, underscores, begin with a letter." );
						// From jquery.validate.js (by joern), contributed by Scott Gonzalez: http://projects.scottsplayground.com/email_address_validation/
						bValid = bValid && checkRegexp( email, /^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i, "eg. ui@jquery.com" );
						if ( bValid ) {
							/**
							 * Do stuff with data!
							 **/
							$( this ).dialog( "close" );
						}
					},
					Cancel: function() {
						$( this ).dialog( "close" );
					}
				},
				close: function() {
					allFields.val( "" ).removeClass( "ui-state-error" );
				}
			});

			$( "#create-student-button" )
				.button()
				.click(function() {
					$( "#create-student-dialog-form" ).dialog( "open" );
				});
		});
		</script>
				
		<div class="form-add">
		
		<div id="create-student-dialog-form" title="Create new student">
			<p class="validateTips">All form fields are required.</p>
		
			<table class="form">
			<tbody>
				<tr>
					<td><label for="fname">First name</label></td>
					<td><input type="text" name="fname" id="fname" class="text ui-widget-content ui-corner-all" /></td>
				</tr>
				<tr>
					<td><label for="lname">Last name</label></td>
					<td><input type="text" name="lname" id="lname" class="text ui-widget-content ui-corner-all" /></td>
				</tr>
				<tr>
					<td><label for="address">Address</label></td>
					<td><input type="text" name="address" id="address" class="text ui-widget-content ui-corner-all" /></td>
				</tr>
				<tr>
					<td><label for="phone_nbr">Phone number</label></td>
					<td><input type="text" name="phone_nbr" id="phone_nbr" class="text ui-widget-content ui-corner-all" /></td>
				</tr>
				<tr>
					<td><label for="email">E-mail address</label></td>
					<td><input type="text" name="email" id="email" class="text ui-widget-content ui-corner-all" /></td>
				</tr>
			</tbody>
			</table>
		</div>
		
		<button id="create-student-button">Create new student!</button>
		
		</div><!-- End demo -->

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