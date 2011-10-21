<?php
	include 'inc/proto_ui.inc'; //UI functions.
	app_head( $title = "Project :: The Application" );
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
		<div class="form-insert">
		<div id="message-insert" class="ui-message-box"></div>
		
		<div id="create-student-dialog-form" title="Create new student">
		<script type="text/javascript">
		$(function() {
			var ssn		= $( "#ssn" ),
			fname			= $( "#fname" ),
			lname			= $( "#lname" ),
			address		= $( "#address" ),
			phone_nbr	= $( "#phone_nbr" ),
			email			= $( "#email" ),
			type			= $( "#student-type");
			allFields	= $( [] )
				.add( ssn )
				.add( fname )
				.add( lname )
				.add( address )
				.add( phone_nbr )
				.add( email )
				.add( type ),
			
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
				height: 500,
				width: 400,
				modal: true,
				buttons: {
					"Create!": function() {
						var bValid = true;
						allFields.removeClass( "ui-state-error" );
						
						if ($("input[name='student_type']:checked").val() == "domestic") {
							bValid = bValid && checkLength( ssn, "ssn", 6, 6 );
							bValid = bValid && checkRegexp( ssn, /^([0-9])+$/i, "Socal security number must consist of only numbers." );
						} else {
							ssn.val("null");
						}
						bValid = bValid && checkLength( fname, "fname", 3, 45 );
						bValid = bValid && checkLength( lname, "lname", 3, 45 );
						bValid = bValid && checkLength( address, "address", 5, 255 );
						bValid = bValid && checkLength( phone_nbr, "phone_nbr", 5, 45 );
						bValid = bValid && checkLength( email, "email", 6, 45 );

						bValid = bValid && checkRegexp( fname, /^[a-zåäö]([0-9a-z_åäö])+$/i, "First name may consist of a-z + å, ä and ö, 0-9, underscores and must begin with a letter." );
						bValid = bValid && checkRegexp( lname, /^[a-zåäö]([0-9a-z_åäö])+$/i, "Last name may consist of a-z + å, ä and ö, 0-9, underscores and must begin with a letter." );
						bValid = bValid && checkRegexp( address, /^[a-zåäö]([0-9a-zåäö\s])+$/i, "Address may consist of a-z + å, ä and ö, 0-9, spaces and must begin with a letter." );
						bValid = bValid && checkRegexp( phone_nbr, /^[+]([0-9-])+$/i, "Phone number may consist of 0-9, hyphens and begin with a plus." );
						// From jquery.validate.js (by joern), contributed by Scott Gonzalez: http://projects.scottsplayground.com/email_address_validation/
						bValid = bValid && checkRegexp( email, /^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i, "eg. ui@jquery.com" );
						if ( bValid ) {
							// POST shit to PHP script.
							
							var t = $("input[name='student_type']:checked").val();
							
							$.post( "server_scripts/create_student.php", {
								ssn: ssn.val(),
								fname: fname.val(),
								lname: lname.val(),
								address: address.val(),
								phone_nbr: phone_nbr.val(),
								email: email.val(),
								type: t
								
							},
							function(data) {
								$( "#message-insert" ).empty().append( data ).addClass( "ui-state-highlight" );
								setTimeout(function() {
									$( "#message-insert" ).removeClass( "ui-state-highlight", 1500 );
								}, 500 );
							});
							
							// POST shit to PHP script.
							
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
			<p class="validateTips">All form fields are required.</p>
		
			<form class="js-form">
				<label for="ssn">Social security number</label>
				<br />
				<input type="text" name="ssn" id="ssn" class="text ui-widget-content ui-corner-all" />
				<br />
				<br />
				<label for="fname">First name</label>
				<br />
				<input type="text" name="fname" id="fname" class="text ui-widget-content ui-corner-all" />
				<br />
				<br />
				<label for="lname">Last name</label>
				<br />
				<input type="text" name="lname" id="lname" class="text ui-widget-content ui-corner-all" />
				<br />
				<br />
				<label for="address">Address</label>
				<br />
				<input type="text" name="address" id="address" class="text ui-widget-content ui-corner-all" />
				<br />
				<br />
				<label for="phone_nbr">Phone number</label>
				<br />
				<input type="text" name="phone_nbr" id="phone_nbr" class="text ui-widget-content ui-corner-all" />
				<br />
				<br />
				<label for="email">E-mail address</label>
				<br />
				<input type="text" name="email" id="email" class="text ui-widget-content ui-corner-all" />
				<br />
				<br />
				<label for="student_type">Student type</label>
				<br />
				<input type="radio" name="student_type" value="domestic" />Domestic<br />
				<input type="radio" name="student_type" value="foreign" />Foreign
			</form>
		</div>
		
		<button id="create-student-button">Create new student!</button>
		
		</div><!-- End CREATE-STUDENT -->

	</div>
	<div id="update">
	</div>
	<div id="search">
		<div class="form-select">
			<div id="message-select" class="ui-message-box"></div>
			
		</div>
	</div>
	<div id="common-searches">
	</div>
</div>

<div class="right-col all-rounded">
<div id="test"></div>
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
	app_foot();
?>
