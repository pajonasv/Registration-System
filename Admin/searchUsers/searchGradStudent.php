<!doctype html>
<?php 
    
    include '../global.php';
    if(!isset($_COOKIE['user']) || $_COOKIE['userType'] != "Admin"){
        header("Location:  $baseURL/homepage/homepage.php"); 
        die();
    }
?>
<html lang="en">
    <head>
        <title>Graduate Student Search</title>
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
    <h1>Graduate Student Search</h1>
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
    <p><label><b>Study Year</b></label>
                <select name="studyYear" id="studyYear">
                <option value='any'>Any</option>
                <option value='1'>First Year</option>
                <option value='2'>Second Year</option>
                <option value='3'>Third Year</option>
                </select>
    </div>

    <div>
    <p><label><b>Start Year</b></label>
                <select name="startYear" id="startYear">
                <option value='any'>Any</option>
                <option value='2017'>2017</option>
                <option value='2018'>2018</option>
                <option value='2019'>2019</option>
                <option value='2020'>2020</option>
                <option value='2021'>2021</option>
                </select>
    </div>

    <div>
    <p><label><b>Graduation Year</b></label>
                
    <input type="number" class="field" placeholder="Graduation Year" name="graduationYear"  min = "2017" max = "2030"></p>
    </div>
    <div>
    <p><label><b>Status</b></label>
                <select name="gradStatus" id="gradStatus">
                <option value='any'>Any</option>
                <option value='Full Time'>Full Time</option>
                <option value='Part Time'>Part Time</option>
                </select>
    </div>

    <div>
    <label for="Bachelor's Degree"><b>Student's Bachelor's Degree: </b></label>
    <input type="text" id="bachelorsDegree" pattern="[A-Za-z]{1,100}"  title="Please enter 1-100 alphabetical characters" name="bachelorsDegree">
    </div>

    <div>
    <label for="Graduate Program"><b>Student's Graduate Program: </b></label>
    <input type="text" id="graduateProgram" pattern="[A-Za-z]{1,100}"  title="Please enter 1-100 alphabetical characters" name="graduateProgram">
    </div>

    <div>
    <p><label><b>Minimum GPA</b></label>
    <input type="number" name="minGPA" min="0" max = "4" value="0" step=".01">
    </div>
    <div>
    <p><label><b>Maximum GPA</b></label>
    <input type="number" name="maxGPA" min="0" max="4" value="4" step=".01">
    </div>


	
    <input type = "hidden" name = "userType" value = "gradStudent" />


    <p><input type="submit" value="Submit">
    <input type="button" onclick="sendRedirectForm(0)" value="Cancel"></p>

	</form>

    <form action= "../../scripts/redirect.php" method="post" id="redirectForm">
        </form>
    </body>
</html>