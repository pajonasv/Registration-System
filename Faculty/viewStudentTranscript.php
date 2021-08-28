<!doctype html>
<?php 
    
    include '../global.php';
    if(!isset($_COOKIE['user']) || $_COOKIE['userType'] != "Faculty"){
        header("Location:  $baseURL/homepage/homepage.php"); 
        die();
    }
?>
<html lang="en">
    <head>
        <title>View Student's Transcript</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="faculty.css">
        <script type="text/javascript">
            function sendRedirectForm(value){
                var id;
                switch(value){
                    case 0:
                        id = "facultyHomepage"
                        break;
                }

                var submissionFrom = document.getElementById("redirectForm"); 

                submissionFrom.innerHTML = "<input type = \"hidden\" name = \"webpage\" value = "+ id +" />";

                submissionFrom.submit();
            }
        </script>
    </head>
    <body>
        <h1>View Student's Transcript</h1>
        
        <div>
            <form method="post" class="form" action="../scripts/viewTranscriptOfStudent.php">
                <p><b>Enter a student's ID number to view their transcript.</b></p>
                <br></br>

                <label><b>Student ID:</b></label>
                <input type="text" class="field" placeholder="Enter Student ID #" pattern="\d{0,10}" title="Please enter numeric user ID" name="StudentID" required>
                <br></br>

                <p><input type="submit" value="Submit">
                <input type="button" onclick="sendRedirectForm(0)" value="Cancel"></p>
            </form>
        </div>
        <form action= "../scripts/redirect.php" method="post" id="redirectForm">
        </form>
    </body>
</html>