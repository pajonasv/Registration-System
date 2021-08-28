
<!doctype html>
<html lang="en">
<?php 
    
    include '../global.php';
    if(!isset($_COOKIE['user']) || $_COOKIE['userType'] != "Student"){
        header("Location:  $baseURL/homepage/homepage.php"); 
        die();
    }
    $conn = connectToDB();
    $sql = "SELECT userID from undergradstudent WHERE userID = " . $_COOKIE['userID'];
    $result = mysqli_query($conn, $sql);
    if($result->num_rows == 0){
    
        $studentType = "Graduate";
    
    }else{
        
        $studentType = "Undergraduate";

    }
?>

    <head>
        <title>Student Homepage</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="student.css">
        <script type="text/javascript">
            function sendRedirectForm(value){
                var id;
                switch(value){
                    case 0:
                        id = "logout"
                        break;
                    case 1:
                        id = "addClass"
                        break;
                    case 2:
                        id = "dropCourseSection"
                        break;
                    case 3:
                        id = "editMajors"
                        break;
                    case 5:
                        id = "editMinor"
                        break;
                    case 7:
                        id = "viewTranscript"
                        break;
                    case 8:
                        id = "masterSchedule"
                        break;
                    case 9:
                        id = "viewDegreeAudit"
                        break;
                    case 10:
                        id = "viewAdvisors"
                        break;
                    case 11:
                        id = "viewCourseList"
                        break;
                    case 12:
                        id = "studentViewHolds"
                        break;
                    case 13:
                        id = "viewMyCourses";
                        break;
                    case 14:
                        id = "changePass"
                        break;
                    case 15:
                        id = "degreeAudit";
                        break;
                    case 16:
                        id = "changeGradProgram";
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
            <h1>Welcome, Student!</h1>
        </div>
        <div class="linkContainer">
            <div class="buttonContainer" onclick="sendRedirectForm(0)">
                <h3>Log out</h3>
            </div>

            <div class="buttonContainer" onclick="sendRedirectForm(1)">
                <h3>Add Class</h3>
            </div>

            <div class="buttonContainer" onclick="sendRedirectForm(2)">
                <h3>Drop Class</h3>
            </div>

            <?php
            if($studentType == "Undergraduate"){
            echo "
            <div class='buttonContainer' onclick='sendRedirectForm(3)'>
                <h3>Edit Majors</h3>
            </div>

            <div class='buttonContainer' onclick='sendRedirectForm(5)'>
                <h3>Edit Minor</h3>
            </div>";
            
            }
            else{
                echo "
            <div class='buttonContainer' onclick='sendRedirectForm(16)'>
                <h3>Change Grad Program</h3>
            </div>";
            }

            ?>
            <div class="buttonContainer" onclick="sendRedirectForm(7)">
                <h3>View Transcript</h3>
            </div>

            <div class="buttonContainer" onclick="sendRedirectForm(8)">
                <h3>View Master Schedule</h3>
            </div>

            <div class="buttonContainer"  onclick="sendRedirectForm(15)">
                <h3>View Degree Audit</h3>
            </div>

            <div class="buttonContainer" onclick="sendRedirectForm(10)">
                <h3>View Advisors</h3>
            </div>

            <div class="buttonContainer" onclick="sendRedirectForm(13)">
                <h3>View My Courses</h3>
            </div>

            <div class="buttonContainer" onclick="sendRedirectForm(12)">
                <h3>View Holds</h3>
            </div>

            <div class="buttonContainer" onclick="sendRedirectForm(14)">
                <h3>Change Password</h3>
            </div>
        </div>
        
        <form action= "../scripts/redirect.php" method="post" id="redirectForm">
        </form>
    </body>
</html>