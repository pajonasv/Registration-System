<!doctype html>
<?php 
    
    include '../../global.php';
    if(!isset($_COOKIE['user']) || $_COOKIE['userType'] != "Admin"){
        header("Location:  $baseURL/homepage/homepage.php"); 
        die();
    }
?>
<html lang="en">
    <head>
        <title>Faculty Search</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="searchUsers.css">
        <script type="text/javascript">
            function sendRedirectForm(value){
                var id;
                switch(value){
                    case 0:
                        id = "adminHomepage"
                        break;
                }

                var submissionFrom = document.getElementById("redirectForm"); 

                submissionFrom.innerHTML = "<input type = \"hidden\" name = \"webpage\" value = "+ id +" />";

                submissionFrom.submit();
            }
        </script>
    </head>
    <body>
    <h1>Faculty Search</h1>
	<form method="post" action="result.php">

    <div>
    <p><label><b>User ID: </b></label>
    <input type="number" class="field" placeholder="User ID" name="userID"></p>
    </div>
    
    <div>
    <label for="User First Name"><b>User First Name: </b></label>
    <input type="text" id="FName" pattern="[A-Za-z]{1,25}"  title="Please enter 1-25 alphabetical characters" name="FName">
    </div>
    
    <div>
    <label for="User Last Name"><b>User Last Name: </b></label>
    <input type="text" id="LName" pattern="[A-Za-z]{1,25}"  title="Please enter 1-25 alphabetical characters" name="LName">
    </div>

    <div>
    <label for="User email address"><b>User Email Address: </b></label>
    <input type="email" id="email" name="email">
    </div>

    <div>
    <p><label><b>Phone Number: </b></label>
    <input type="tel" id="phoneNumber" name="phoneNumber" placeholder = "123-456-7890" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" >
    <small>Format: 123-456-7890</small>
    </div>

    <div>
    <p><label><b>Faculty Type</b></label>
                <select name="facultyType" id="facultyType">
                <option value='any'>Any</option>
                <option value='Full Time'>Full Time</option>
                <option value='Part Time'>Part Time</option>
                </select>
    </div>

    <div>
    <p><label><b>Faculty Rank</b></label>
                <select name="facultyRank" id="facultyRank">
                <option value='any'>Any</option>
                <option value='Junior'>Junior</option>
                <option value='Senior'>Senior</option>
                <option value='Manager'>Manager</option>
                <option value='Head'>Head</option>
                </select>
    </div>
    
    <div>
    <p><label><b>Office ID: </b></label>
    <input type="number" class="field" placeholder="Office ID" name="officeID"></p>
    </div>

    <div>
    <p><label><b>Salary/Wages: </b></label>
    <input type="number" class="field" placeholder="Salary/Wages" name="salary"></p>
    </div>

    <input type = "hidden" name = "userType" value = "faculty" />
	
    <p><input type="submit" value="Submit">
    <input type="button" onclick="sendRedirectForm(0)" value="Cancel"></p>

	</form>

    <form action= "../../scripts/redirect.php" method="post" id="redirectForm">
        </form>
    </body>
</html>