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
        <title>Update Grade Submission Window</title>
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
        <h1>Update Grade Submission Window</h1>
        <div>
            <form method="post" class="form" action= "../scripts/updateGradeSubmissionWindow.php" onsubmit="return confirm('Are you sure you want to submit the form?')">

                <label><b>Semester:</b></label>
                <select name="Semester" id="Semester">
                    <option value='0'>Spring 2021</option>
                    <option value='1'>Fall 2021</option>
                </select>
                
                <p><label><b>Start Date of Window:</b></label>
                <input type="date" id="start" name="GradeWindowStartDate" min="2021-01-25" max="2021-12-18" required></p>

                <p><label><b>End Date of Window:</b></label>
                <input type="date" id="start" name="GradeWindowEndDate" min="2021-01-25" max="2021-12-18" required></p>

                <p><input type="submit" value="Submit">
                <input type="button" onclick="sendRedirectForm(0)" value="Cancel"></p>
            </form>
        </div>

        <form action= "../scripts/redirect.php" method="post" id="redirectForm">
        </form>
    </body>
</html>