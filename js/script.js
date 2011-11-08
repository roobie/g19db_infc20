/*
 *		JavaScripts
 *
 *		Här samlar vi alla javascript som ska köras i koden.
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
  /**

  	Globala funktioner
  	Denna uppdaterar "tips" till det man skickar in till den. 

**/
function updateTips( t ) {
	tips
		.text( t )
		.addClass( "ui-state-highlight" );
	setTimeout(function() {
		tips.removeClass( "ui-state-highlight", 1500 );
	}, 500 );
}

/**

	Tar 4 parametrar och returnerar true eller false beroende på om strängen man skickar är inom minmaxintervallet

 **/
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

/**

	Tar 3 parametrar och returnerar true eller false beroende på om strängen man skickar är går genom regexpet

 **/
function checkRegexp( o, regexp, n ) {
	if ( !( regexp.test( o.val() ) ) ) {
		o.addClass( "ui-state-error" );
		updateTips( n );
		return false;
	} else {
		return true;
	}
}

/**

	Ändrar höjde på sidan.

 **/
function adjust_height(arg) {
	$("#content").height( arg );
	$("#sidebar").height( arg );
	$("#main").height( arg );
}

/**

	Söker student


**/
function search_student(term) {
	if ( term != null && term != '' && term.length != 0 ) {
		$.post( 'includes/app/scripts/search_student.php', {
    		search_term: term
	        }, function(data) {
		        $('#app_table').empty().append(data);
		        adjust_height(($('#app_table').height() + 200));
		        manipulate_student_table();
	    	}
	    );
	} else {
	    $.post( 'includes/app/scripts/search_student.php', {
	    		search_term: $('#student-search-term-tf').val()
	        }, function(data) {
		        $('#app_table').empty().append(data);
		        adjust_height(($('#app_table').height() + 200));
		        manipulate_student_table();
	    	}
	    );
	}
}

function search_course(term) {
	$('#app_table').empty();
	if ( term != null && term != '' && term.length != 0 ) {
		setTimeout( function() {
			$.post( 'includes/app/scripts/search_course.php', {
	    		search_term: term
		        }, function(data) {
			        $('#app_table').empty().append(data);
			        adjust_height(($('#app_table').height() + 200));
			        manipulate_course_table();

		    	}
		    );
		}, 1500);
	} else {
	    $.post( 'includes/app/scripts/search_course.php', {
	    		search_term: $('#course-search-term-tf').val()
	        }, function(data) {
		        $('#app_table').empty().append(data);
		        adjust_height(($('#app_table').height() + 200));
		        manipulate_course_table();

	    	}
	    );
	}
}

/**

	This is for UPDATING STUDENTS

 **/
function manipulate_student_table () {
	var ssn		= $( "#update-ssn" ),
	fname		= $( "#update-fname" ),
	lname		= $( "#update-lname" ),
	address		= $( "#update-address" ),
	phone_nbr	= $( "#update-phone_nbr" ),
	email		= $( "#update-email" ),
	type		= $( "#update-student-type");
	allFields	= $( [] )
		.add( ssn )
		.add( fname )
		.add( lname )
		.add( address )
		.add( phone_nbr )
		.add( email )
		.add( type ),
	
	tips = $( ".validateTips" )

	db_id = 0;
	
	$( "#update-student-dialog-form" ).dialog({
		autoOpen: false,
		height: 550,
		width: 400,
		modal: true,
		buttons: {
			"Update!": function() {
				var bValid = true;
				allFields.removeClass( "ui-state-error" );
				
				if ($("input[name='update-student_type']:checked").val() == "domestic") {
					bValid = bValid && checkLength( ssn, "ssn", 6, 12 );
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
					var t = $("input[name='update-student_type']:checked").val();
					$.post( "includes/app/scripts/update_student.php", {
						ssn: ssn.val(),
						fname: fname.val(),
						lname: lname.val(),
						address: address.val(),
						phone_nbr: phone_nbr.val(),
						email: email.val(),
						type: t,
						id: db_id
						
					},
					function(data) {
						$( "#message-container" ).empty().append( data ).addClass( "ui-state-highlight" );
						setTimeout(function() {
							$( "#message-container" ).removeClass( "ui-state-highlight", 1500 );
						}, 500 );
					});
					
					$( this ).dialog( "close" );
					setTimeout(function	() {
						search_student (), 1000
					});
				}
			},
			Cancel: function() {
				$( this ).dialog( "close" );
			},
			"Add to course": function () {
				$("#student_id").val(db_id);
				populate_courses_list(db_id);
				$( "#add-student-to-course-dialog" ).dialog( "open" );
			},
			"Delete!": function() {
				$("#idstudent").val(db_id);
				removestudent(db_id);
				$( this ).dialog( "close" );
			},
		},
		close: function() {
			allFields.val( "" ).removeClass( "ui-state-error" );
		}
	});

	$(".student-tr").click(function () { 
		$( "#update-student-dialog-form" ).dialog( "open" );
		ssn.val($(this).attr('id'));
		var tmp	= $( [] );
		
		$(this).children().each(function () {
			tmp.push($(this).text()); // "this" is the current element in the loop
		});

		var names = tmp[0].split(" ");

		ssn.val(tmp[2]);
		fname.val(names[0]);
		lname.val(names[1]);
		address.val(tmp[3]);
		phone_nbr.val(tmp[4]);
		email.val(tmp[5]);

		db_id = tmp[1];

		if (tmp[6] == 'no') { // WORKS
			document.getElementById("update-student_type_domestic").checked = true
		} else if (tmp[6] == 'yes'){
			document.getElementById("update-student_type_foreign").checked = true
		}
    });
    
    $(".student-tr").hover(function () {
    	$( this ).addClass("selected_student");
    }, function () {
    	$( this ).removeClass("selected_student");
    });

}

function manipulate_course_table () {
	var ccode		= $( "#update-ccode" ),
	cname		= $( "#update-cname" ),
	points = $( "#update-points" ),

	allFields	= $( [] )
		.add( ccode )
		.add( cname )
		.add( points ),

	
	tips = $( ".validateTips" )

	db_id = 0;
	
	$( "#update-course-dialog-form" ).dialog({
		autoOpen: false,
		height: 550,
		width: 400,
		modal: true,
		buttons: {
			"Update!": function() {
				var bValid = true;
				allFields.removeClass( "ui-state-error" );
				
				bValid = bValid && checkLength( ccode, "ccode", 3, 45 );
				bValid = bValid && checkLength( cname, "cname", 1, 45 );
				bValid = bValid && checkLength( cname, "points", 1, 45 );

				bValid = bValid && checkRegexp( ccode, /^[a-zåäö]([a-z_åäö])+$/i, "Course Code may consist of a-z + å, ä and ö, 0-9, underscores and must begin with a letter." );
				bValid = bValid && checkRegexp( cname, /^[a-zåäö]([a-z_åäö])+$/i, "Course Name may consist of a-z + å, ä and ö, 0-9, underscores and must begin with a letter." );
				bValid = bValid && checkRegexp( points, /^([0-9-])+$/i, "Points may consist of 0-9" );					
					$.post( "includes/app/scripts/update_course.php", {
						ccode: ccode.val(),
						cname: cname.val(),
						points: points.val(),
						id: db_id
						
					},
					function(data) {
						$( "#message-container" ).empty().append( data ).addClass( "ui-state-highlight" );
						setTimeout(function() {
							$( "#message-container" ).removeClass( "ui-state-highlight", 1500 );
						}, 500 );
					});
					
					$( this ).dialog( "close" );
					setTimeout(function	() {
						search_course (), 1000
					});
				}
			},
			Cancel: function() {
				$( this ).dialog( "close" );
			},
		close: function() {
			allFields.val( "" ).removeClass( "ui-state-error" );
		}
	});

	$(".course-tr").click(function () {
		course_tabs();
		$.post("includes/app/scripts/get_students_on_course.php", {
			idc: $( this ).children()[2].textContent
		},
			function (data) {
				$("#students-tab").empty().append(data);
			}
		);
		$.post("includes/app/scripts/get_sections_on_course.php", {
			idc: $( this ).children()[2].textContent
		},
			function ( data ) {
				$("#sections-tab").empty().append(data);
			}
		);
		ccode.val($(this).attr('id'));
		var tmp	= $( [] ) ;
		
		$(this).children().each(function () {
			tmp.push($(this).text()); // "this" is the current element in the loop
		});
		
		var names = tmp[0];

		ccode.val(tmp[1]);
		cname.val(tmp[2]);
		points.val(tmp[3]);


		db_id = tmp[1];

    });
    
    $(".course-tr").hover(function () {
    	$( this ).addClass("selected_course");
    }, function () {
    	$( this ).removeClass("selected_course");
    });

}

/**

	Denna hanterar lägga till student. Bör finnas motsvarande för varje entitet i databasen

 **/
function open_create_student() {
	var ssn		= $( "#ssn" ),
	fname		= $( "#fname" ),
	lname		= $( "#lname" ),
	address		= $( "#address" ),
	phone_nbr	= $( "#phone_nbr" ),
	email		= $( "#email" ),
	type		= $( "#student-type");
	allFields	= $( [] )
		.add( ssn )
		.add( fname )
		.add( lname )
		.add( address )
		.add( phone_nbr )
		.add( email )
		.add( type ),
	
	tips = $( ".validateTips" );
	
	$( "#create-student-dialog-form" ).dialog({
		autoOpen: false,
		height: 550,
		width: 400,
		modal: true,
		buttons: {
			"Create!": function() {
				var bValid = true;
				allFields.removeClass( "ui-state-error" );
				
				if ($("input[name='student_type']:checked").val() == "domestic") {
					bValid = bValid && checkLength( ssn, "ssn", 6, 12 );
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
					
					$.post( "includes/app/scripts/create_student.php", {
						ssn: ssn.val(),
						fname: fname.val(),
						lname: lname.val(),
						address: address.val(),
						phone_nbr: phone_nbr.val(),
						email: email.val(),
						type: t
						
					},
					function(data) {
						$( "#message-container" ).empty().append( data ).addClass( "ui-state-highlight" );
						setTimeout(function() {
							$( "#message-container" ).removeClass( "ui-state-highlight", 1500 );
						}, 500 );
					});
					
					$( this ).dialog( "close" );
					setTimeout(function() {
						search_student(email.val())
					}, 1000);
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
}

	function open_create_course() {
	var ccode		= $( "#ccode" ),
	cname		= $( "#cname" ),
	points		= $( "#points" ),

	allFields	= $( [] )
		.add( ccode )
		.add( cname )
		.add( points )

	
	tips = $( ".validateTips" );
	

	$( "#create-course-dialog-form" ).dialog({
		autoOpen: false,
		height: 550,
		width: 400,
		modal: true,
		buttons: {
			"Add!": function() {
				var bValid = true;
				allFields.removeClass( "ui-state-error" );
				
				bValid = bValid && checkLength( ccode, "ccode", 3, 45 );
				bValid = bValid && checkLength( cname, "cname", 1, 45 );
				bValid = bValid && checkLength( points, "points", 1, 45 );

				bValid = bValid && checkRegexp( ccode, /^[a-zåäö]([a-z_åäö])+$/i, "Course Code may consist of a-z + å, ä and ö, 0-9, underscores and must begin with a letter." );
				bValid = bValid && checkRegexp( cname, /^[a-zåäö]([a-z_åäö])+$/i, "Course Name may consist of a-z + å, ä and ö, 0-9, underscores and must begin with a letter." );
				bValid = bValid && checkRegexp( points, /^([0-9-])+$/i, "Points may consist of 0-9" );		
					$.post( "includes/app/scripts/create_course.php", {
						ccode: ccode.val(),
						cname: cname.val(),
						cpoints: points.val(),

						
					},
					function(data) {
						$( "#message-container" ).empty().append( data ).addClass( "ui-state-highlight" );
						setTimeout(function() {
							$( "#message-container" ).removeClass( "ui-state-highlight", 1500 );
						}, 500 );
					});
					
					$( this ).dialog( "close" );
					search_course(ccode.val());
				}
			},
			Cancel: function() {
				$( this ).dialog( "close" );
			},
			
			close: function() {
			allFields.val( "" ).removeClass( "ui-state-error" );
		}
	});
}

$( "#create-course-button" )
	.button()
	.click(function() {
		$( "#create-course-dialog-form" ).dialog( "open" );
});

$( "#add-student-to-course-dialog" ).dialog ({
	autoOpen: false,
	height: 550,
	width: 400,
	modal: true,
	buttons: {
		"Add": function() {
			$.post("includes/app/scripts/add_student_to_course.php", {
				idstudent: db_id,
				idcourse: $("#courses-list").children(":selected").attr("value")
				}, function(data) {
					$("#message-container").empty().append( "Student added to course!" ).addClass("ui-state-highlight");
			})
			$( "#add-student-to-course-dialog" ).dialog( "close" );
		},
		Cancel: function() {
			$( this ).dialog( "close" );
		}
	}
});

function populate_courses_list (studentId) {
	$.post("includes/app/scripts/get_possible_courses.php", {
			sid: studentId
		},
		function(data) {
			$("#courses-list").empty().append(data);
		}
	);
}


function removestudent (studentId) {
	$.post("includes/app/scripts/remove_student.php", {
		idstudent: db_id,
		}, function(data) {
			$("#message-container").empty().append( data ).addClass("ui-state-highlight");
		}
	);
	setTimeout(function() {
		search_student()
		}, 1000)
}


function removecourse (courseId) {
	$.post("includes/app/scripts/remove_course.php", {
		idcourse: db_id,
		}, function(data) {
			$("#message-container").empty().append( data ).addClass("ui-state-highlight");
		}
	);
	setTimeout(function() {
		search_course()
		}, 1000)
}


function course_tabs () {
	$("#app_table").empty().append('<div id="course_tabs"></div>');
	$("#course_tabs")
	.append('<ul><li><a href="#students-tab">Students</a></li><li><a href="#sections-tab">Sections</a></li></ul>')
	.append('<div id="students-tab"></div>')
	.append('<div id="sections-tab"></div>')
	.tabs();
}

open_create_student();
open_create_course();
manipulate_student_table();
manipulate_course_table();
