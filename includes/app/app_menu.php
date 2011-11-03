<div id="tabs" class="app_menu">
                
    <ul>
        <li><a href="#create">Create</a></li>
        <li><a href="#update">Update</a></li>
        <li><a href="#search">Search</a></li>
        <li><a href="#common-searches">Common searches</a></li>
    </ul>

    <div id="create">
        <div class="form-insert">
            <div id="message-insert" class="ui-message-box">
            </div>

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
                    <input type="radio" name="student_type" value="domestic">Domestic<br>
                    <input type="radio" name="student_type" value="foreign">Foreign
                </form>
            </div><button id="create-student-button">Create new student!</button>
        </div><!-- End CREATE-STUDENT -->
    </div>

    <div id="update"></div>

    <div id="search">
        <div class="form-select">
            <div id="message-select" class="ui-message-box"></div>
        </div>
    </div>

    <div id="common-searches"></div>
</div>