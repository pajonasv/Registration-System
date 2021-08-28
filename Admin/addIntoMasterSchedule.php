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
        <title>Add Into Master Schedule</title>
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
        <h1>Add Into Master Schedule</h1>
        <div>
            <form method="post" class="form" action= "../scripts/addIntoMasterSchedule.php" onsubmit="return confirm('Are you sure you want to submit the form?')">
                <p><b>Add Course Into Schedule</b></p>

                <p><label><b>CRN: </b></label>
                <input type="text" class="field" placeholder="Enter CRN #" name="CRN" required></p>

                <p><label><b>Course Section: </b></label>
                <input type="text" class="field" placeholder="Enter Course Section #" name="CourseSectionNumber" required></p>

                <p><label><b>Faculty ID: </b></label>
                <input type="text" class="field" placeholder="Enter Faculty ID #" name="CourseName" required></p>

                <p><label><b>Room Number: </b></label>
                <input type="text" class="field" placeholder="Enter Room #" name="RoomNumber" required></p>

                <p><label><b>Semester</b></label>
                <select name="Semester" id="Semester">
                    <option>Spring 2021</option>
                    <option>Fall 2021</option>
                </select>

                <br></br>
                <table>
                <tr>
                    <p for="Days"><b>Days: </b></p>

                    <td width="11%" class="pldefault">
                    <input type="checkbox" name="select_day" value="m" id="monday">
                    <abbr title="Monday">Mon</abbr>
                    </td>

                    <td width="11%" class="pldefault">
                    <input type="checkbox" name="select_day" value="t" id="tuesday">
                    <abbr title="Monday">Tue</abbr>
                    </td>

                    <td width="11%" class="pldefault">
                    <input type="checkbox" name="select_day" value="w" id="wednesday">
                    <abbr title="Monday">Wed</abbr>
                    </td>

                    <td width="11%" class="pldefault">
                    <input type="checkbox" name="select_day" value="th" id="thursday">
                    <abbr title="Monday">Thur</abbr>
                    </td>

                    <td width="11%" class="pldefault">
                    <input type="checkbox" name="select_day" value="f" id="friday">
                    <abbr title="Monday">Fri</abbr>
                    </td>

                    <td width="11%" class="pldefault">
                    <input type="checkbox" name="select_day" value="s" id="saturday">
                    <abbr title="Monday">Sat</abbr>
                    </td>

                    <td width="11%" class="pldefault">
                    <input type="checkbox" name="select_day" value="sun" id="sunday">
                    <abbr title="Monday">Sun</abbr>
                    </td>
                </tr>
                </table>
<br></br>
                <p><label><b>Periods: </b></label></p>

                <div class = "startTimeContainer">
                <label for="StartTime"><b>Start time: </b></label>
                <input type = "time" id="startTime" name = "startTime"
                        min="09:00" max="20:00">
                </div>
                <br>

                <div>
                <label for="EndTime"><b>End time: </b></label>
                <input type = "time" id="endTime" name = "endTime"
                        min="09:00" max="20:00">
                </div>
                <br>

                <p><input type="submit" value="Submit">
                <input type="button" onclick="sendRedirectForm(0)" value="Cancel"></p>
            </form>
        </div>
        <form action= "../scripts/redirect.php" method="post" id="redirectForm">
        </form>
        
        
    </body>
</html>