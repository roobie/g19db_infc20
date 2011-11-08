
<div id="content2">
	<div id="search">
        <div class="form-select">
            <div id="message-select" class="ui-message-box"></div>
            Students: 
            <input
                id="student-search-term-tf" 
                type="text" 
                name="student-search-term"
                placeholder="Enter a search term, please ..."
                class="text ui-widget-content ui-corner-all"
                onkeydown=" if ( event.keyCode == 13 ) search_student()">
            
            Courses: 
            <input
                id="course-search-term-tf" 
                type="text" 
                name="course-search-term"
                placeholder="Enter a search term, please ..."
                class="text ui-widget-content ui-corner-all"
                onkeydown=" if ( event.keyCode == 13 ) search_course()">
        </div><!-- END FORM select -->
    </div><!-- END search -->
</div>