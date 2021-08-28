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
        <title>Add a Course Section</title>
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
        <h1>Add a Course Section For Fall 2021</h1>


        <div>
            <form method="post" class="form" action= "../scripts/addCourseSection.php" onsubmit="return confirm('Are you sure you want to submit the form?')">

                <p><label><b>Course ID: </b></label>
                <input type="text" class="field"  pattern="([a-zA-Z0-9\s]){1,10}"  title="Please enter 1-10 alphanumeric characters" placeholder="Course ID" name="CourseID" required></p>

                <p><label><b>Faculty ID: </b></label>
                <input type="text" class="field" pattern="\d{0,10}" title="Please enter numeric user ID" placeholder="Faculty ID #" name="FacultyID" required></p>

                <p><label><b>Room ID: </b></label>
                <input type="number" min='0' max='1000000000'class="field" placeholder="Enter Room #" name="RoomID" required></p>

                <p><label><b>Total Seats: </b></label>
                <input type="number" min='0' max='1000000000'class="field" placeholder="Enter Total Seats" name="totalSeats" required></p>


                <br></br>
                <table>
                <tr>
                    <p for="Days"><b>Days: </b></p>

                    <td width="11%" class="pldefault">
                    <input type="radio" name="select_day" value="mw" id="monwed" required>
                    <abbr title="MonWed">Mon/Wed</abbr>
                    </td>

                    <td width="11%" class="pldefault">
                    <input type="radio" name="select_day" value="tt" id="tuethur">
                    <abbr title="TueThur">Tue/Thur</abbr>
                    </td>

                    <td width="11%" class="pldefault">
                    <input type="radio" name="select_day" value="f" id="fri">
                    <abbr title="Fri">Fri</abbr>
                    </td>

                </tr>
                </table>
                <br></br>

                <div>
                <label><b>Period Number:</b></label>
                <input type = "number" id="period" name = "period" min="1" max="7" step="1" required>
                </div>
                <br></br>

                <p><input type="submit" value="Submit">
                <input type="button" onclick="sendRedirectForm(0)" value="Cancel"></p>
            </form>
        </div>
        <form action= "../scripts/redirect.php" method="post" id="redirectForm">
        </form>

        
        
    </body>
</html>