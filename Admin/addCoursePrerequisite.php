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
        <title>Add Course Prerequisites</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="admin.css">
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
        <h1>Add Course Prerequisites</h1>

        <div>
        <form method="post" class="form" action= "../scripts/addPrerequisite.php" onsubmit="return confirm('Are you sure you want to submit the form?')">
                <p><b>Enter the Course ID. (This course will need the prerequisites to be completed.) </b></p>

                <p><label><b>Course ID: </b></label>
                <input type="text" class="field" pattern="([A-Z]){2}([0-9]){4}"  title="Please enter 2 alphabetic and 4 numeric characters" placeholder="Course ID" name="courseID" required></p>
                <br></br>

                <p><label><b>Course ID of the course that will be assigned as prerequisite: </b></label>
                <input type="text" class="field" pattern="([A-Z]){2}([0-9]){4}"  title="Please enter 2 alphabetic and 4 numeric characters" placeholder="Prerequisite ID" name="prereqID" required></p>

                <p><label><b>Credit Requirement: </b></label>
                <input type="number" class="field" placeholder="Credit Requirement" name="creditRequirement" min=0 max=120 required></p>

                <label for="gradeRequirement"><b>Minimum Grade Required (<b class="gradeRequirement">MGR</b>) for the course: </b></label>
                    <select name="gradeRequirement" id="gradeRequirement">
                        <option value = "C">C</option>
                        <option value = "B">B</option>
                        <option value = "A">A</option>
                    </select>
                <br></br>

                <p><input type="submit" value="Submit">
                <input type="button" onclick="sendRedirectForm(0)" value="Cancel"></p>
            </form>
        </div>

        <form action= "../scripts/redirect.php" method="post" id="redirectForm">
        </form>
        
        
    </body>
</html>