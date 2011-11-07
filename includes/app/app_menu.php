
<!-- Tabs 
=============================================================================================== -->
<div id="tabs" class="app_menu">
    <div id="message-container" class="ui-message-box"><a href="includes/app/scripts/create_database.php"></a></div>      
    <ul>
        <li><a href="#create">Create</a></li>
        <li><a href="#search">Search</a></li>
    </ul>

    <div id="create">
        <div class="form-insert">
            <button id="create-student-button">Create new student</button>
            <button id="create-course-button">Create new course</button>
			</br>
        </div><!-- END form -->
    </div><!-- End CREATE-STUDENT -->

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
</div><!-- END TABS -->

<!-- Forms 
=============================================================================================== -->
<div id="create-student-dialog-form" title="Create new student">
    <p class="validateTips">All form fields are required.</p>
    <form class="js-form">
        <label for="ssn">Social security number</label><br>
        <input type="text" name="ssn" id="ssn" class="text ui-widget-content ui-corner-all"><br>
        <br>
        <label for="fname">First name</label><br>
        <input type="text" name="fname" id="fname" class="text ui-widget-content ui-corner-all"><br>
        <br>
        <label for="lname">Last name</label><br>
        <input type="text" name="lname" id="lname" class="text ui-widget-content ui-corner-all"><br>
        <br>
        <label for="address">Address</label><br>
        <input type="text" name="address" id="address" class="text ui-widget-content ui-corner-all"><br>
        <br>
        <label for="phone_nbr">Phone number</label><br>
        <input type="text" name="phone_nbr" id="phone_nbr" class="text ui-widget-content ui-corner-all"><br>
        <br>
        <label for="email">E-mail address</label><br>
        <input type="text" name="email" id="email" class="text ui-widget-content ui-corner-all"><br>
        <br>
        <label for="student_type">Student type</label><br>
        <input id ="student_type_domestic" type="radio" name="student_type" value="domestic">Domestic<br>
        <input id ="student_type_foreign" type="radio" name="student_type" value="foreign">Foreign
    </form>
</div> <!-- create-student-dialog-form -->

<div id="create-course-dialog-form" title="Create new course">
    <p class="validateTips">All form fields are required.</p>
    <form class="js-form">
        <label for="ccode">Course Code</label><br>
        <input type="text" name="ccode" id="ccode" class="text ui-widget-content ui-corner-all"><br>
        <br>
        <label for="cname">Course Name</label><br>
        <input type="text" name="cname" id="cname" class="text ui-widget-content ui-corner-all"><br>
        <br>
		<label for="points">Points</label><br>
        <input type="text" name="points" id="points" class="text ui-widget-content ui-corner-all"><br>
        <br>
    </form>
</div> <!-- create-course-dialog-form -->

<div id="update-student-dialog-form" title="Update existing student">
    <p class="validateTips">All form fields are required.</p>
    <form class="js-form">
        <label for="update-ssn">Social security number</label><br>
        <input type="text" name="update-ssn" id="update-ssn" class="text ui-widget-content ui-corner-all"><br>
        <br>
        <label for="update-fname">First name</label><br>
        <input type="text" name="update-fname" id="update-fname" class="text ui-widget-content ui-corner-all"><br>
        <br>
        <label for="update-lname">Last name</label><br>
        <input type="text" name="update-lname" id="update-lname" class="text ui-widget-content ui-corner-all"><br>
        <br>
        <label for="update-address">Address</label><br>
        <input type="text" name="update-address" id="update-address" class="text ui-widget-content ui-corner-all"><br>
        <br>
        <label for="update-phone_nbr">Phone number</label><br>
        <input type="text" name="update-phone_nbr" id="update-phone_nbr" class="text ui-widget-content ui-corner-all"><br>
        <br>
        <label for="update-email">E-mail address</label><br>
        <input type="text" name="update-email" id="update-email" class="text ui-widget-content ui-corner-all"><br>
        <br>
        <label for="update-student_type">Student type</label><br>
        <input id ="update-student_type_domestic" type="radio" name="update-student_type" value="domestic">Domestic<br>
        <input id ="update-student_type_foreign" type="radio" name="update-student_type" value="foreign">Foreign
    </form>
</div> <!-- update-student-dialog-form -->



<div id="add-student-to-course-dialog" title="Add student to course">
    <p class="validateTips">All form fields are required.</p>
    <form class="js-form">
        <label for="student_id">Student</label><br>
        <input type="text" name="student_id" id="student_id" class="text ui-widget-content ui-corner-all" readonly><br>
        <br>
        <select name="courses" id="courses-list">
            <option value="test">test</option>
        </select>

    </form>
</div>