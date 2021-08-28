<!doctype html>
<html lang="en">
<?php 
    
    include '../global.php';
    if(!isset($_COOKIE['user']) || $_COOKIE['userType'] != "Admin"){
        header("Location:  $baseURL/homepage/homepage.php"); 
        die();
    }
?>

    <head>
        <title>Admin Homepage</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="admin.css">
        <script type="text/javascript">
            function sendRedirectForm(value){
                var id;
                switch(value){
                    case 0:
                        id = "logout"
                        break;
                    case 1:
                        id = "addStudentAccount"
                        break;
                    case 2:
                        id = "updateAccount"
                        break;
                    case 3:
                        id = "addFacultyAccount"
                        break;
                    case 4:
                        id = "updateFacultyAccount"
                        break;
                    case 5:
                        id = "addResearcherAccount"
                        break;
                    case 7:
                        id = "addAdminAccount"
                        break;
                    case 9:
                        id = "removeAccount"
                        break;
                    case 10:
                        id = "assignFacultyAdvisor"
                        break;
                    case 11:
                        id = "removeFacultyAdvisor"
                        break;
                    case 12:
                        id = "listAdvisors"
                        break;
                    case 13:
                        id = "listUnderGradStudents"
                        break;
                    case 14:
                        id = "listGradStudents"
                        break;
                    case 15:
                        id = "addCourseSection"
                        break;
                    case 16:
                        id = "updateCourseSection"
                        break;
                    case 17:
                        id = "removeCourseSection"
                        break;
                    case 18:
                        id = "addHold"
                        break;
                    case 19:
                        id = "removeHold"
                        break;
                    case 20:
                        id = "addCoursePrerequisite"
                        break;
                    case 21:
                        id = "removeCoursePrerequisite"
                        break;
                    case 22:
                        id = "listCourses"
                        break;
                    case 23:
                        id = "registerStudentToCourse"
                        break;
                    case 24:
                        id = "changePass"
                        break;
                    case 25:
                        id = "viewHoldForStudent"
                        break;
                    case 26:
                        id = "searchUsers"
                        break;
                    case 27:
                        id = "updateAddDropWindow"
                        break;
                    case 28:
                        id = "updateGradeSubmissionWindow"
                        break;
                    case 29:
                        id = "masterSchedule"
                        break;
                    case 30:
                        id = "AdminDegreeAudit"
                        break;
                    case 31:
                        id = "AdminTranscript"
                        break;
                    case 32:
                        id = "EditStudentsMajors"
                        break;
                    case 33:
                        id = "EditStudentsMinor"
                        break;
                    case 34:
                        id = "addCourse"
                        break;
                    case 35:
                        id = "deleteCourse"
                        break;
                    case 36:
                        id = "adminEditGrade"
                        break;
                    case 37:
                        id = "viewAllRooms"
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
            <h1>Welcome, Admin!</h1>
        </div>
        <div class="linkContainer">
            <div class="buttonContainer" onclick="sendRedirectForm(0)">
                <h3>Log out</h3>
            </div>
            <div class="buttonContainer" onclick="sendRedirectForm(29)">
                <h3>View Master Schedule</h3>
            </div>
            <div class="buttonContainer" onclick="sendRedirectForm(26)">
                <h3>Search Users</h3>
            </div>
            <div class="buttonContainer" onclick="sendRedirectForm(1)">
                <h3>Add Student Account</h3>
            </div>

            <div class="buttonContainer" onclick="sendRedirectForm(3)">
                <h3>Add Faculty Account</h3>
            </div>

            <div class="buttonContainer" onclick="sendRedirectForm(5)">
                <h3>Add Reseacher Account</h3>
            </div>


            <div class="buttonContainer" onclick="sendRedirectForm(7)">
                <h3>Add Admin Account</h3>
            </div>

            <div class="buttonContainer" onclick="sendRedirectForm(2)">
                <h3>Update Account</h3>
            </div>
            <div class="buttonContainer" onclick="sendRedirectForm(9)">
                <h3>Remove Account</h3>
            </div>
            
            <div class="buttonContainer" onclick="sendRedirectForm(10)">
                <h3>Assign Faculty Advisor to Student</h3>
            </div>
            
            <div class="buttonContainer" onclick="sendRedirectForm(11)">
                <h3>Remove Faculty Advisor from Student</h3>
            </div>
            
            <div class="buttonContainer" onclick="sendRedirectForm(12)">
                <h3>View Advisors</h3>
            </div>
            <div class="buttonContainer" onclick="sendRedirectForm(37)">
                <h3>View all Rooms</h3>
            </div>
            
            <div class="buttonContainer" onclick="sendRedirectForm(15)">
                <h3>Add Course Section</h3>
            </div>
            
            <div class="buttonContainer" onclick="sendRedirectForm(16)">
                <h3>Update Course Section</h3>
            </div>

            <div class="buttonContainer" onclick="sendRedirectForm(17)">
                <h3>Remove Course Section</h3>
            </div>

            <div class="buttonContainer" onclick="sendRedirectForm(18)">
                <h3>Add Hold</h3>
            </div>

            <div class="buttonContainer" onclick="sendRedirectForm(25)">
                <h3>View Hold For Student</h3>
            </div>

            <div class="buttonContainer" onclick="sendRedirectForm(19)">
                <h3>Remove Hold</h3>
            </div>

            <div class="buttonContainer" onclick="sendRedirectForm(34)">
                <h3>Add Course</h3>
            </div>

            <div class="buttonContainer" onclick="sendRedirectForm(35)">
                <h3>Delete Course</h3>
            </div>

            <div class="buttonContainer" onclick="sendRedirectForm(20)">
                <h3>Add Course Prerequisite</h3>
            </div>

            <div class="buttonContainer" onclick="sendRedirectForm(21)">
                <h3>Remove Course Prerequisite</h3>
            </div>

            <div class="buttonContainer" onclick="sendRedirectForm(22)">
                <h3>View Courses</h3>
            </div>

            <div class="buttonContainer" onclick="sendRedirectForm(30)">
                <h3>View Student Degree Audit</h3>
            </div>
            <div class="buttonContainer" onclick="sendRedirectForm(31)">
                <h3>View Student Transcript</h3>
            </div>

            <div class="buttonContainer" onclick="sendRedirectForm(32)">
                <h3>Edit Student's Majors</h3>
            </div>

            <div class="buttonContainer" onclick="sendRedirectForm(33)">
                <h3>Edit Student's Minor</h3>
            </div>

            <div class="buttonContainer" onclick="sendRedirectForm(23)">
                <h3>Register Student to Course</h3>
            </div>
            
            <div class="buttonContainer" onclick="sendRedirectForm(24)">
                <h3>Change Password</h3>
            </div>

            <div class="buttonContainer" onclick="sendRedirectForm(27)">
                <h3>Update Add/Drop Window</h3>
            </div>

            <div class="buttonContainer" onclick="sendRedirectForm(28)">
                <h3>Update Grade Submission Window</h3>
            </div>

            <div class="buttonContainer" onclick="sendRedirectForm(36)">
                <h3>Update Student Course Grade</h3>
            </div>
        </div>

        <form action= "../scripts/redirect.php" method="post" id="redirectForm">
        </form>
    </body>
</html>