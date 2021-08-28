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
        <title>Register Student to a Course</title>
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
        <h1>Register Student to a Course</h1>
        <div>
            <form method="post" class="form" action="../scripts/registerForCourse.php" onsubmit="return confirm('Are you sure you want to submit the form?')">
                <p><b>Enter the student's ID Number who will be assigned a course.</b></p>

                <p><label><b>Student ID: </b></label>
                <input type="text" class="field" pattern="\d{0,10}" title="Please enter numeric user ID" placeholder="Student ID #" name="studentID" required></p>
                <br></br>

                <p><b>Enter the Course CRN of the course that the student will be taking. </b></p>

                <p><label><b>CRN: </b></label>
                <input type="text" class="field" pattern="\d{0,10}" title="Please enter numeric CRN" placeholder="Course CRN" name="CRN" required></p>
                <br></br>

                <p><input type="submit" value="Submit">
                <input type="button" onclick="sendRedirectForm(0)" value="Cancel"></p>
            </form>
        </div>

        <form action= "../scripts/redirect.php" method="post" id="redirectForm">
        </form>
        
    </body>
</html>