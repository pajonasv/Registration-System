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
        <title>Remove Course Prerequisites</title>
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
        <h1>Remove Course Prerequisites</h1>

        <div>
            <form method="post" class="form" action="../scripts/removeCoursePrerequisite.php" onsubmit="return confirm('Are you sure you want to submit the form?')">
                <p><b>Enter the Course ID. (This course will have the prerequisites removed as requirements.) </b></p>

                <p><label><b>Course ID: </b></label>
                <input type="text" class="field"  pattern="([a-zA-Z0-9\s]){1,10}"  title="Please enter 1-10 alphanumeric characters" placeholder="Course ID" name="courseID" required></p>
                <br></br>

                <p><b>Enter the Course ID. (These courses will be removed as the prerequisites.)  </b></p>

                <p><label><b>ID of the course that will be removed as a prerequisite: </b></label>
                <input type="text" class="field"  pattern="([a-zA-Z0-9\s]){1,10}"  title="Please enter 1-10 alphanumeric characters" placeholder="Course ID" name="prereqID" required></p>

                <br></br>


                <p><input type="submit" value="Submit">
                <input type="button" onclick="sendRedirectForm(0)" value="Cancel"></p>
            </form>
        </div>

        <form action= "../scripts/redirect.php" method="post" id="redirectForm">
        </form>
        
        
    </body>
</html>