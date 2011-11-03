/*
 *		JavaScripts
 *
 *		Här samlar vi alla javascript som ska köras i koden
 */


//	Få smma höjd på sidebar och content
$(window).load( function() {  			
	if ( $("#main").height() > $("#sidebar").height() && $("#main").height() > $("#content").height() ) {
		$("#content").height( $("#main").height() );
		$("#sidebar").height( $("#main").height() );
	}
	
	else if ( $("#content").height() > $("#sidebar").height() ) {
		$("#main").height( $("#content").height() );
		$("#sidebar").height( $("#content").height() );
	}
	
	else if ( $("#sidebar").height() > $("#content").height() ) {
		$("#main").height( $("#sidebar").height() );
		$("#content").height( $("#sidebar").height() );
	}
	
	else {
		$("#main").height( $("#sidebar").height() );
	}
});


//	Switch theme
$(function() {
	document.styleSheets[2].disabled = true;
	$( "#switch-theme-button" )
	.button()
	.click(function() {
		var styleSheets = document.styleSheets;
		if (styleSheets[1].disabled == true) {
			styleSheets[1].disabled = false;
			styleSheets[2].disabled = true;
		} else
		if (styleSheets[2].disabled == true) {
			styleSheets[2].disabled = false;
			styleSheets[1].disabled = true;
		}
	});
});

// 	Scriptet för sidomenyn i sidebar
$(function() {
	$( "#nav" ).accordion({
		event: "mouseover"
	});
});

//	Funktion för mouseover on tabs i Applikation-sidan
$(function() {
	$( "#tabs" ).tabs({
		event: "mouseover"
	});
});




/* ==|== Applikation ============================================================================
	Alla scripts som ska köras på Applikation-sidan.
   ============================================================================================== */

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
				bValid = bValid && checkLength( lname, "lname", 1, 45 );
				bValid = bValid && checkLength( address, "address", 5, 255 );
				bValid = bValid && checkLength( phone_nbr, "phone_nbr", 5, 45 );
				bValid = bValid && checkLength( email, "email", 6, 45 );

				bValid = bValid && checkRegexp( fname, /^[a-zåäö]([a-z_åäö])+$/i, "First name may consist of a-z + å, ä and ö, 0-9, underscores and must begin with a letter." );
				bValid = bValid && checkRegexp( lname, /^[a-zåäö]([a-z_åäö])+$/i, "Last name may consist of a-z + å, ä and ö, 0-9, underscores and must begin with a letter." );
				bValid = bValid && checkRegexp( address, /^[a-zåäö]([0-9a-zåäö\s])+$/i, "Address may consist of a-z + å, ä and ö, 0-9, spaces and must begin with a letter." );
				bValid = bValid && checkRegexp( phone_nbr, /^[+]([0-9-])+$/i, "Phone number may consist of 0-9, hyphens and begin with a plus." );
				// From jquery.validate.js (by joern), contributed by Scott Gonzalez: http://projects.scottsplayground.com/email_address_validation/
				bValid = bValid && checkRegexp( email, /^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i, "It seems like the mail address is not valid.. Please try again." );
				if ( bValid ) {
					var t = $("input[name='student_type']:checked").val();
					
					$.post( "inc/create_student.php", {
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