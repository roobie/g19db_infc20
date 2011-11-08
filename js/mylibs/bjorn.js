/**
===============================================================================
GLOBAL helper functions
===============================================================================
**/
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

function adjust_height(arg) {
	$("#content").height( arg );
	$("#sidebar").height( arg );
	$("#main").height( arg );
}

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

/**
===============================================================================
**/
/**
===============================================================================
ANONYMOUS functions
===============================================================================
**/
// Control the height
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

// 	Creates an accordion of the sidebar
$(function() {
	$( "#nav" ).accordion({
		event: "mouseover"
	});
});

//	Creates tabs in the app
$(function() {
	$( "#tabs" ).tabs({
		event: "mouseover"
	});
});
/**
===============================================================================
**/