<!doctype html>
<html lang="en">
<?php 
    
    include '../global.php';
    if(!isset($_COOKIE['user']) || $_COOKIE['userType'] != "Faculty"){
        header("Location:  $baseURL/homepage/homepage.php"); 
        die();
    }
?>
    <head>
        <title>Faculty Homepage</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="faculty.css">
        <script type="text/javascript">
            function sendRedirectForm(value){
                var id;
                switch(value){
                    case 0:
                        id = "logout"
                        break;
                    case 1:
                        id = "editGrade"
                        break;
                    case 2:
                        id = "coursesTaught"
                        break;
                    case 3:
                        id = "adviseesList"
                        break;
                    case 4:
                        id = "viewStudentTranscript"
                        break;
                    case 5:
                        id = "viewStudentDegreeAudit"
                        break;
                    case 6:
                        id = "viewCourseSectionStudentList"
                        break;
                    case 7:
                        id = "changePass"
                        break;
                    case 8:
                        id = "masterSchedule"
                        break;
                }

                var submissionFrom = document.getElementById("redirectForm"); 

                submissionFrom.innerHTML = "<input type = \"hidden\" name = \"webpage\" value = "+ id +" />";

                submissionFrom.submit();
            }      
        </script>
    </head>
    
    <body>
        <div>
            <h1>Welcome, Faculty!</h1>
        </div>
        <div class="linkContainer">
            <div class="buttonContainer" onclick="sendRedirectForm(0)">
                <h3>Log out</h3>
            </div>

            <div class="buttonContainer" onclick="sendRedirectForm(8)">
                <h3>View Master Schedule</h3>
            </div>

            <div class="buttonContainer" onclick="sendRedirectForm(1)">
                <h3>Edit Student's grade</h3>
            </div>

            <div class="buttonContainer" onclick="sendRedirectForm(2)">
                <h3>View list of courses taught</h3>
            </div>

            <div class="buttonContainer" onclick="sendRedirectForm(3)">
                <h3>View list of advisees</h3>
            </div>

            <div class="buttonContainer" onclick="sendRedirectForm(4)">
                <h3>View transcript of student</h3>
            </div>

            <div class="buttonContainer" onclick="sendRedirectForm(5)">
                <h3>View degree audit of student</h3>
            </div>

            <div class="buttonContainer" onclick="sendRedirectForm(6)">
                <h3>View list of students in course-section</h3>
            </div>

            <div class="buttonContainer" onclick="sendRedirectForm(7)">
                <h3>Change Password</h3>
            </div>
        </div>

        <form action= "../scripts/redirect.php" method="post" id="redirectForm">
        </form>
    </body>
</html>